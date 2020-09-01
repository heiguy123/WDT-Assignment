<?php
include_once("_admin.function.php");
if (isset($_GET['food'])) {
    resetimg($_GET['food']);
} else {
    echo '<table class="table showorder">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody id="viewbody">';
    displaymenulist();
    echo '</tbody>
    </table>
</div>';
}
