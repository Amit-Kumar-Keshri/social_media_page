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
<?php if (isset($_GET['chatlist'])) { ?>
    <div class="collapse mt-3" id="collapseExample">
        <div class="chat_window_section">
            <ul class="friend-list ">
                <!-- /* curently this showing user profile but it needs to shown friend list here */ -->
                <?php
                foreach ($all_friends as $key => $value) {
                    if ($value != $_COOKIE['login_auth']) {
                        $row = retrive_data($value);
                        ?>
                        <li class="row align-items-center p-3" data-user-id="<?= $row['id']; ?>">
                            <div class=" col-4 w-auto friend-img rounded-circle gx-3"><img class="rounded-circle"
                                    src="uploads/<?= $row['profile_image'] ?>" alt="user profile photo" /></div>
                            <div class=" col friend-info">
                                <h4 class="m-0">
                                    <?= $row['name']; ?>
                                </h4>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <div class="chat_box_message">
            </div>
            <div class="chat_box" style="display: none;">
                <div class=" d-flex justify-content-start align-items-center p-3  border-0">
                    <img class="rounded-circle" src="uploads/<?= $profile_image; ?>" alt=""
                        style="width: 40px; height: 100%;">
                    <input type="text" class="form-control form-control-lg ms-1"
                        placeholder="Type message">
                    <a class="ms-1 text-black" href="#!"><i class="fas fa-paperclip"></i></a>
                    <a class="ms-3 text-black" href="#!"><i class="fas fa-smile"></i></a>
                    <a class="ms-3 text-black chat-send-btn" href="#!"><i class="fas fa-paper-plane"></i></a>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-info btn-lg chat-list-toggler" data-mdb-toggle="collapse" href="#collapseExample" role="button"
        aria-expanded="false" aria-controls="collapseExample">
        <div class="d-flex justify-content-between align-items-center">
            <span>Collapsible Chat App</span>
            <i class="fas fa-chevron-up"></i>
            <i class="fas fa-chevron-down" style="display: none;"></i>
        </div>
    </a>

<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!-- Bootstrap JS CDN -->
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>