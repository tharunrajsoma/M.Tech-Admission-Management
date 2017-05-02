<!DOCTYPE html>
<html>
<head>
    <base href="http://demos.telerik.com/kendo-ui/grid/sorting">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.223/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.223/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.223/styles/kendo.material.mobile.min.css" />

    <script src="https://kendo.cdn.telerik.com/2017.1.223/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.1.223/js/kendo.all.min.js"></script>
</head>
<body>
        <script src="../content/shared/js/orders.js"></script>

        <div id="example">

            <div class="demo-section k-content wide">
                <h4>Grid with single column sorting enabled</h4>
                <div id="singleSort"></div>
            </div>

            <div class="demo-section k-content wide">
                <h4>Grid with multiple column sorting enabled</h4>
                <div id="multipleSort"></div>
            </div>

            <script>
                $(document).ready(function () {
                    $("#singleSort").kendoGrid({
                        dataSource: {
                            data: orders,
                            pageSize: 6
                        },
                        sortable: {
                            mode: "single",
                            allowUnsort: false
                        },
                        pageable: {
                            buttonCount: 5
                        },
                        scrollable: false,
                        columns: [
                            {
                                field: "ShipCountry",
                                title: "Ship Country",
                                sortable: {
                                  initialDirection: "desc"  
                                },
                                width: 300
                            },
                            {
                                field: "Freight",
                                width: 300
                            },
                            {
                                field: "OrderDate",
                                title: "Order Date",
                                format: "{0:dd/MM/yyyy}"
                            }
                        ]
                    });

                    $("#multipleSort").kendoGrid({
                        dataSource: {
                            data: orders,
                            pageSize: 6
                        },
                        sortable: {
                            mode: "multiple",
                            allowUnsort: true
                        },
                        pageable: {
                            buttonCount: 5
                        },
                        scrollable: false,
                        columns: [
                            {
                                field: "ShipCountry",
                                title: "Ship Country",
                                width: 300
                            },
                            {
                                field: "Freight",
                                width: 300
                            },
                            {
                                field: "OrderDate",
                                title: "Order Date",
                                format: "{0:d}"
                            }
                        ]
                    });
                });
            </script>
            <style>
                .demo-section h3 {
                    margin: 5px 0 15px 0;
                }
            </style>
        </div>


</body>
</html>
