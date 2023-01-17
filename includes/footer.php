<footer class="">
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-black">&copy; 2022 Company, Inc</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#twitter" />
                        </svg></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#instagram" />
                        </svg></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#facebook" />
                        </svg></a></li>
            </ul>
        </footer>
    </div>
</footer>

<div class="chat_window_section" style="display: none;">
<ul class="friend-list clearfix">
    <!-- /* curently this showing user profile but it needs to shown friend list here */ -->
    <?php
    foreach ($all_friends as $key => $value) {
        if($value!=$_COOKIE['login_auth']) {
            $row = retrive_data($value);
    ?>
            <li data-user-id="<?= $row['id']; ?>">
                <a href="#" class="">
                    <div class="friend-img"><img src="uploads/<?= $row['profile_image'] ?>" alt="user profile photo" /></div>
                    <div class="friend-info">
                        <h4><?= $row['name']; ?></h4>
                    </div>
                </a>
            </li>
        <?php } ?>
    <?php } ?>
</ul>
<div class="chat_box_message">
</div>
<div class="chat_box" style="display: none;">
    <textarea></textarea>
    <button class="btn btn-primary text-center chat-send-btn">Send</button>
</div>
</div>
<div class="chat_bubble">
    <img src="assets/images/Chat-PNG-Clipart.png" />
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!-- Bootstrap JS CDN -->
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>