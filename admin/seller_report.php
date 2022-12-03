<?php include './component/header.php' ?>

<div class="seller_rep">
    <h3>Seller's</h3>

    <div class="seller" id="seller">
        <!-- Seller data from seller_page.php -->
    </div>
    <hr>
</div>

<script>
    $(document).ready(function() {
        function loadBuyer(spage) {
            $.ajax({
                url: 'seller_page.php',
                type: 'POST',
                data: {
                    page_s: spage
                },
                success: function(sdata) {
                    $('#seller').html(sdata);
                }
            })
        }
        loadBuyer();

        //Buyer pagination
        $(document).on("click", "#pagination a", function(e) {
            e.preventDefault();
            var spage_id = $(this).attr("id");
            loadBuyer(spage_id);
        })
    })
</script>


<?php include './component/footer.php' ?>