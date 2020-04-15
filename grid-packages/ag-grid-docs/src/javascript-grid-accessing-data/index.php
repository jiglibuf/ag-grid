<?php
$pageTitle = "ag-Grid - Working with Data: Accessing Data";
$pageDescription = "ag-Grid is a feature-rich data grid supporting major JavaScript Frameworks. One such feature is Accessing Data. Once data is in the grid, you can Access the Data using the grid's API. Free and Commercial version available.";
$pageKeywords = "ag-Grid Accessing Data";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<h1>Accessing Data</h1>

<p class="lead">
    This section covers the ways data can be accessed once it has been supplied to the grid.
</p>

<p>
    Each time you pass data to the grid, the grid wraps each data item
    with a <a href="../javascript-grid-row-node/"><code>rowNode</code></a> object.
    For example if your data has 20 rows, then the grid creates 20 <code>rowNode</code>
    objects, each <code>rowNode</code> wrapping one item of your data.
</p>

<p>
    It is sometimes handy to access these <code>rowNode</code>s. One example where it is handy
    is if you want to select a row, you can call <code>rowNode.setSelected(true)</code>
    to select it. This section details the different ways a <code>rowNode</code> can be accessed.
</p>

<p>
    The following methods are provided for accessing the individual <code>rowNode</code>s.
    A deeper explanation of these methods, along with examples, are provided
    further down.
</p>

<h2>Accessing Row Node API Methods</h2>

<?php createDocumentationFromFile('../javascript-grid-api/api.json', 'rowNodes') ?>

<h2 id="access-node-by-id">Accessing RowNode by ID</h2>

<p>
    The easiest way to get a <code>rowNode</code> is by its ID.
    The ID is either provided by you using the grid callback <code>getRowNodeId()</code>,
    or generated by the grid using an internal sequence.
</p>

<?= createSnippet(<<<SNIPPET
// callback tells the grid to use the 'id' attribute for IDs
// IDs should always be strings
gridOptions.getRowNodeId = function(data) {
    return data.id;
};

// get the row node with ID 55
var rowNode = api.getRowNode('55');

// do something with the row, e.g. select it
rowNode.setSelected(true);
SNIPPET
) ?>

<p>
    Accessing the rowNode by ID is available in the <a href="../javascript-grid-client-side-model/">Client-side
    Row Model</a> only.
</p>

<h2 id="for-each-node">Iterating Rows</h2>

<p>
    Sometimes you may want to iterate through all the rowNodes in the grid.
    This can be done using the grid's iteration APIs. The iteration APIs
    go through every rowNode, regardless of whether the rowNode is displayed
    or not. For example if grouping and the group is closed, the group's children
    are not displayed by the grid, however the children are included in the
    iteration 'for-each' methods.
</p>

<?= createSnippet(<<<SNIPPET
// iterate through every node in the grid
api.forEachNode(function(rowNode, index) {
    console.log('node ' + rowNode.data.athlete + ' is in the grid');
});

// iterate only nodes that pass the filter
api.forEachNodeAfterFilter(function(rowNode, index) {
    console.log('node ' + rowNode.data.athlete + ' passes the filter');
});

// iterate only nodes that pass the filter and ordered by the sort order
api.forEachNodeAfterFilterAndSort(function(rowNode, index) {
    console.log('node ' + rowNode.data.athlete + ' passes the filter and is in this order');
});

// iterate through every leaf node in the grid
api.forEachLeafNode(function(rowNode, index) {
    console.log('node ' + rowNode.data.athlete + ' is not a group!');
});
SNIPPET
) ?>

<p>
    All of the methods above work with the <a href="../javascript-grid-client-side-model/">Client-side
    Row Model</a>. For all the other row models (<a href="../javascript-grid-viewport/">Viewport</a>,
    <a href="../javascript-grid-infinite-scrolling/">Infinite</a> and
    <a href="../javascript-grid-server-side-model/">Server-side</a>) the only method that is supported
    is <code>api.forEachNode()</code> and that will return back row nodes that are loaded into
    browser memory only (as each of these row models use a data source to lazy load rows).
</p>

<h2 id="example-api">Example Using For-Each Methods</h2>

<p>
    The example below shows the different for-Each API methods as follows:
</p>

<ul class="content">
    <li><b>For-Each Node</b>: Prints out every row in the grid. It ignores filtering and sorting.</li>
    <li><b>For-Each Node After Filter</b>: Prints out every row in the grid, except those filtered out.</li>
    <li><b>For-Each Node After Filter and Sort</b>: Prints our every row in the grid, except those filtered,
        and is the same order they appear in the screen if sorting is applied.</li>
    <li><b>For-Each Leaf Node</b>: Prints out every row in the grid except group rows.</li>
</ul>

<p>
    In the example, try applying some sorts and filters, and see how this impacts the different operations.
</p>

<?= grid_example('Using For-Each', 'using-for-each', 'generated', ['enterprise' => true, 'exampleHeight' => 590]) ?>

<?php include '../documentation-main/documentation_footer.php';?>
