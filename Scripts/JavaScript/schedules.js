// when page loads, retreive database info
$(document).ready(function () {
    $('#editable_table').Tabledit({
        url: 'Scripts/Php/action.php',
        columns: {
            identifier: [0, "area"],
            editable: [[1, 'day'], [2, 'start'], [3, 'end'], [4, 'driver'], [5, 'truck']]
        },
        restoreButton: false
    });

});