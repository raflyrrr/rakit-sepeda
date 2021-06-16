<div class="d-flex flex-column align-items-stretch flex-shrink-0 mt-4" style="width: 250px;">
    <a href="#" class="d-flex flex-shrink-0 p-3 link-light text-decoration-none border-bottom" style="background-color: #962d2d; border-radius:4px;"  >
        <span class="fs-5 fw-semibold">Kategori</span>
    </a>
    <div class="list-group list-group-flush border-bottom scrollarea">
            <?php $sql = mysqli_query($con, "select id,categoryName  from category");
                while ($row = mysqli_fetch_array($sql)) {
                ?>
        <a href="category.php?cid=<?php echo $row['id']; ?>" class="list-group-item list-group-item-action py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
            <strong class="mb-1"><?php echo $row['categoryName']; ?></strong>
            </div><?php } ?>
        </a>
    </div>
</div>