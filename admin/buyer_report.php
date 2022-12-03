<?php include './component/header.php' ?>
<link rel="stylesheet" href="./assets/css/buyer_report.css">
<div class="buyer_rep">
<h3>Buyer's</h3>
<div class="buyer" id="buyer">
    <!-- buyer data from buyer_page.php -->
</div>
<hr>
</div>

<script>
    $(document).ready(function() {
        function loadBuyer(bpage){
            $.ajax({
                url: 'buyer_page.php',
                type: 'POST',
                data: {page_b : bpage},
                success: function(bdata){
                    $('#buyer').html(bdata);
                }
            })
        }
        loadBuyer();

        //Buyer pagination
        $(document).on("click","#pagination a", function(e){
            e.preventDefault();
            var bpage_id = $(this).attr("id");
            loadBuyer(bpage_id);
        })
    })
</script>



<?php include './component/footer.php' ?>