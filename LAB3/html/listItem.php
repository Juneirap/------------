<?php
include "condb.php";

$sql = "SELECT * FROM tb_member ORDER BY member_name ASC";
$result = mysqli_query($conn, $sql);

// var_dump($result);
?>

<!-- Button trigger modal -->
<button id="btn_add" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    + ADD
</button>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?= $row['id_member'] ?></td>
                <td><?= $row['member_name'] ?></td>
                <td><?= $row['member_email'] ?></td>
                <td><button class="btn_id" data-id="<?= $row['id_member'] ?>">del</button></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script>
    $(function() {
        $(".btn_id").click(function() {
            let id = $(this).data('id');
            console.log(id);

            $.ajax({
                url: "/delitem.php",
                method: "GET",
                data: {
                    mem_id: id
                },
                success: function(res) {
                    if (res == 'error')
                        alert("Can't delete item.");
                    else
                        $("#tb_member").load("/listItem.php");
                }
            });
        });

        $("#btn_add").click(function() {
            $("#staticBackdropLabel").text("Add member");
            $(".modal-body").load("/add_form.php");
            $(".modal-footer .btn-secondary").text("Cancle");
            $(".modal-footer .btn-primary").text("Save");

        });


    }); //jQuery Ready
</script>