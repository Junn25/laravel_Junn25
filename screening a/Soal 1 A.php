<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 1 A</title>
    <script>
        function generateTable() {
            var baris = document.getElementById("baris").value;
            var kolom = document.getElementById("kolom").value;

            if (baris <= 0 || kolom <= 0) {
                alert("Jumlah baris dan kolom harus lebih dari 0");
                return;
            }

            var oldTable = document.getElementById("generatedTable");
            if (oldTable) {
                oldTable.remove();
            }

            var table = document.createElement("table");
            table.setAttribute("id", "generatedTable");

            for (var i = 1; i <= baris; i++) {
                var tr = document.createElement("tr");
                for (var j = 1; j <= kolom; j++) {
                    var td = document.createElement("td");
                    td.innerHTML = i + "." + j + " <input type='text' name='cell_" + i + "_" + j + "'>";
                    tr.appendChild(td);
                }
                table.appendChild(tr);
            }

            document.body.appendChild(table);

            if (!document.getElementById("submitButton")) {
                var submitButton = document.createElement("button");
                submitButton.setAttribute("id", "submitButton");
                submitButton.setAttribute("type", "button");
                submitButton.setAttribute("onclick", "generateList()");
                submitButton.innerHTML = "Submit";
                document.body.appendChild(submitButton);
            }
        }

        function generateList() {
            var oldList = document.getElementById("generatedList");
            if (oldList) {
                oldList.remove();
            }

            var list = document.createElement("ul");
            list.setAttribute("id", "generatedList");

            var inputs = document.querySelectorAll("#generatedTable input");

            inputs.forEach(function(input) {
                var listItem = document.createElement("li");
                var cellName = input.name.split("_");
                var i = cellName[1];
                var j = cellName[2];
                listItem.innerHTML = i + "." + j + ": " + input.value;
                list.appendChild(listItem);
            });

            document.body.appendChild(list);
        }
    </script>
</head>
<body>
    <h2>Muhammad Jundi Hakim</h2>
    <h3>Soal 1</h3>
    <form onsubmit="event.preventDefault(); generateTable();">
        <table>
            <tr>
                <td><label for="baris">Inputkan Jumlah Baris</label></td>
                <td>: <input type="number" min="1" id="baris" name="baris"></td>
            </tr>
            <tr>
                <td><label for="kolom">Inputkan Jumlah Kolom </label></td>
                <td>: <input type="number" min="1" name="kolom" id="kolom"></td>
            </tr>
            <tr>
                <td><button type="submit">SUBMIT</button></td>
            </tr>
        </table>
    </form>
<br>
</body>
</html>