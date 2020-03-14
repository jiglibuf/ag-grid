var gridOptions = {
    columnDefs: [
        { field: 'athlete', minWidth: 150},
        { field: 'age', maxWidth: 90},
        { field: 'country', minWidth: 150},
        { field: 'year', maxWidth: 90},
        { field: 'date', minWidth: 150},
        { field: 'sport', minWidth: 150},
        { field: 'gold', minWidth: 100},
        { field: 'silver', minWidth: 100},
        { field: 'bronze', minWidth: 100},
        { field: 'total', minWidth: 100}
    ],
    defaultColDef: {
        resizable: true
    },
    onGridSizeChanged: onGridSizeChanged
};

function onGridSizeChanged(params) {
    // get the current grids width
    var gridWidth = document.getElementById('grid-wrapper').offsetWidth;

    // keep track of which columns to hide/show
    var columnsToShow = [];
    var columnsToHide = [];

    // iterate over all columns (visible or not) and work out
    // now many columns can fit (based on their minWidth)
    var totalColsWidth = 0;
    var allColumns = params.columnApi.getAllColumns();
    for (var i = 0; i < allColumns.length; i++) {
        var column = allColumns[i];
        totalColsWidth += column.getMinWidth();
        if (totalColsWidth > gridWidth) {
            columnsToHide.push(column.colId);
        } else {
            columnsToShow.push(column.colId);
        }
    }

    // show/hide columns based on current grid width
    params.columnApi.setColumnsVisible(columnsToShow, true);
    params.columnApi.setColumnsVisible(columnsToHide, false);

    // fill out any available space to ensure there are no gaps
    // params.api.sizeColumnsToFit();
}

// setup the grid after the page has finished loading
document.addEventListener('DOMContentLoaded', function() {
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    // do http request to get our sample data - not using any framework to keep the example self contained.
    // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('GET', 'https://raw.githubusercontent.com/ag-grid/ag-grid/master/grid-packages/ag-grid-docs/src/olympicWinnersSmall.json');
    httpRequest.send();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var httpResult = JSON.parse(httpRequest.responseText);
            gridOptions.api.setRowData(httpResult);
        }
    };
});
