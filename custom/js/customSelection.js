selected = [];

function select(id) {
    if (selected.includes(id)) {
        const index = selected.indexOf(id);
        if (index > -1) {
            selected.splice(index, 1);
        }
        document.getElementById("b" + id).style.background = "#EFEFEF";
        return;
    }
    if (selected.length >= 7) {
        return;
    }
    selected.push(id);
    document.getElementById("b" + id).style.background = "#00FF00";
}

function proceed() {
    if (selected.length !== 7) {
        return false;
    }
    $.ajax({
        type: "POST",
        url: 'storeSelection.php',
        data: {selected: selected, table: 'selected'},

        success: function (obj, textstatus) {
            window.console.log(obj);
            window.console.log("red");
            window.location.href = "stage2.php";
            return false;

        }
    });

}
