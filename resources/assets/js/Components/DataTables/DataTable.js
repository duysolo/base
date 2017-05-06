export class DataTable {
    constructor($table, options = {}) {
        if (!$table) {
            return;
        }

        this.datatable = null;

        this.$table = $table;

        this.ajaxParams = {};

        let _self = this;

        let defaultOptions = {
            loadingMessage: 'Loading...',
            onSuccess: function (grid, response) {
                WebEd.initAjax();
            },
            onError: function (grid) {

            },
            onDataLoad: function (grid) {
                WebEd.initAjax();
            },
            dataTableParams: {
                dom: "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r><'table-responsive't><'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>", // datatable layout
                lengthMenu: [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                pageLength: 10, // default records per page
                language: { // language settings
                    // metronic spesific
                    groupActionCount: "_TOTAL_ records selected:  ",
                    ajaxRequestGeneralError: "Could not complete request. Please check your internet connection",

                    // data tables spesific
                    lengthMenu: "<span class='seperator'>|</span>View _MENU_ records",
                    info: "<span class='seperator'>|</span>Found total _TOTAL_ records",
                    infoEmpty: "No records found to show",
                    emptyTable: "No data available in table",
                    zeroRecords: "No matching records found",
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                        last: "Last",
                        first: "First",
                        page: "Page",
                        pageOf: "of"
                    }
                },
                orderCellsTop: true,
                columnDefs: [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    orderable: false,
                    targets: 0
                }],

                // save datatable state(pagination, sort, etc) in cookie.
                bStateSave: true,

                pagingType: "bootstrap_extended", // pagination type(bootstrap, bootstrap_full_number or bootstrap_extended)
                autoWidth: false, // disable fixed width and enable fluid table
                processing: false, // enable/disable display message box on record load
                serverSide: true, // enable/disable server side ajax loading

                ajax: { // define ajax settings
                    url: "", // ajax URL
                    type: "POST", // request type
                    timeout: 20000,
                    data: function (data) { // add request parameters before submit
                        $.each(_self.ajaxParams, function (key, value) {
                            data[key] = value;
                        });
                        WebEd.blockUI({
                            message: defaultOptions.loadingMessage,
                            target: _self.$tableContainer,
                            overlayColor: 'none',
                            boxed: true
                        });
                    },
                    dataSrc: function (res) { // Manipulate the data returned from the server
                        if (res.customActionMessage) {
                            WebEd.showNotification(res.customActionMessage, res.customActionStatus);
                        }

                        if (res.customActionStatus) {
                            if (tableOptions.resetGroupActionInputOnSuccess) {
                                $('.table-group-action-input', _self.$tableWrapper).val("");
                            }
                        }

                        if ($('.group-checkable', $table).size() === 1) {
                            $('.group-checkable', $table).attr("checked", false);
                        }

                        defaultOptions.onSuccess.call(undefined, _self, res);

                        WebEd.unblockUI(_self.$tableContainer);

                        return res.data;
                    },
                    error: function () { // handle general connection errors
                        this.onError.call(undefined, _self);
                        WebEd.showNotification(this.dataTableParams.language.ajaxRequestGeneralError, 'danger');

                        WebEd.unblockUI($tableContainer);
                    }
                },

                drawCallback: function (settings) {
                    WebEd.initAjax();
                }
            }
        };

        this.options = $.extend(true, defaultOptions, options);

        $.fn.dataTableExt.oStdClasses.sWrapper = $.fn.dataTableExt.oStdClasses.sWrapper + " dataTables_extended_wrapper";
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";
        $.fn.dataTableExt.oStdClasses.sLengthSelect = "form-control input-xs input-sm input-inline";

        this.datatable = this.$table.DataTable(this.options.dataTableParams);

        this.$tableContainer = this.$table.closest('.table-container');
        this.$tableWrapper = this.$table.closest('.dataTables_wrapper');

        this.$tableContainer.addClass('initialized');

        /**
         * Build table group actions panel
         */
        if ($('.table-actions-wrapper', _self.$tableContainer).size() === 1) {
            $('.table-group-actions', _self.$tableWrapper).html($('.table-actions-wrapper', _self.$tableContainer).html()); // place the panel inside the wrapper
            $('.table-actions-wrapper', _self.$tableContainer).remove(); // remove the template container
        }

        /**
         * Submit filter
         */
        this.$table.on('click', '.filter-submit', function (e) {
            e.preventDefault();
            _self.submitFilter();
        });

        /**
         * Cancel filter
         */
        this.$table.on('click', '.filter-cancel', function (e) {
            e.preventDefault();
            _self.resetFilter();
        });

        // handle group checkboxes check/uncheck
        $('[type=checkbox][name=group_checkable]', this.$table).change(function () {
            let set = _self.$table.find('tbody > tr > td:nth-child(1) input[type="checkbox"]');
            let checked = $(this).prop("checked");
            $(set).each(function () {
                $(this).prop("checked", checked);
            });
            _self.countSelectedRows();
        });

        // handle row's checkbox click
        this.$table.on('change', 'tbody > tr > td:nth-child(1) input[type="checkbox"]', function () {
            _self.countSelectedRows();
        });
    }

    countSelectedRows() {
        let selected = $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', this.$table).size();
        let text = this.options.dataTableParams.language.groupActionCount;

        if (selected > 0) {
            $('.table-group-actions > span', this.$tableWrapper).text(text.replace("_TOTAL_", selected));
        } else {
            $('.table-group-actions > span', this.$tableWrapper).text("");
        }

        return selected;
    }

    getColumnInputValue($column) {
        let value = '';
        $('textarea.form-filter, select.form-filter, input.form-filter:not([type="radio"],[type="checkbox"])', $column).each(function () {
            value = $(this).val();
        });

        // get all checkboxes
        $('input.form-filter[type="checkbox"]:checked', $column).each(function () {
            value = $(this).val();
        });

        // get all radio buttons
        $('input.form-filter[type="radio"]:checked', $column).each(function () {
            value = $(this).val();
        });

        return value;
    }

    getDataTableHelper() {
        return this;
    }

    getTable() {
        return this.$table;
    }

    getTableContainer() {
        return this.$tableContainer;
    }

    getTableWrapper() {
        return this.$tableWrapper;
    }

    getDataTable() {
        return this.datatable;
    }

    getSelectedRowsCount() {
        return $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', this.$table).size();
    }

    getSelectedRows() {
        let rows = [];
        $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', this.$table).each(function () {
            rows.push($(this).val());
        });

        return rows;
    }

    setAjaxParam(name, value) {
        this.ajaxParams[name] = value;
    }

    addAjaxParam(name, value) {
        if (!this.ajaxParams[name]) {
            this.ajaxParams[name] = [];
        }

        let skip = false;
        for (let i = 0; i < (this.ajaxParams[name]).length; i++) { // check for duplicates
            if (this.ajaxParams[name][i] === value) {
                skip = true;
            }
        }

        if (skip === false) {
            this.ajaxParams[name].push(value);
        }
    }

    clearAjaxParams() {
        this.ajaxParams = {};
    }

    submitFilter() {
        let $columns = this.$table.find('thead tr.filter > *');
        let totalColumnsIndex = $columns.length - 1;

        for (let i = 0; i < totalColumnsIndex; i++) {
            let value = this.getColumnInputValue($($columns[i]));
            this.datatable.columns(i).search(value);
        }
        this.datatable.ajax.reload();
    }

    resetFilter() {
        $('textarea.form-filter, select.form-filter, input.form-filter', this.$table).each(function () {
            $(this).val("");
        });
        $('input.form-filter[type="checkbox"]', this.$table).each(function () {
            $(this).attr("checked", false);
        });
        this.submitFilter();
    }
}

WebEd.DataTable = DataTable;