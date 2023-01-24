<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-white">&copy; 2023 Social Media Company, Inc</span>
        </div>
    </footer>
    <?php if (!isset($_GET['logout']) && isset($_COOKIE["login_auth"])) { ?>
        <div class="collapse" id="collapseExample">
            <button id="back-button">Back</button>
            <div class="chat_window_section chat-box-body ">

                <ul class="friend-list chat-box-card">
                    <!-- /* curently this showing user profile but it needs to shown friend list here */ -->
                    <?php
                    $all_friends = all_added_users($_COOKIE['login_auth']);
                    foreach ($all_friends as $key => $value) {
                        if ($value != $_COOKIE['login_auth']) {
                            $row = retrive_data($value);
                            ?>
                            <li class="row align-items-center p-3 user" data-reciever-id="<?= $row['id']; ?>">
                                <div class=" col-4 w-auto friend-img rounded-circle gx-3"><img class="rounded-circle"
                                        src="uploads/<?= $row['profile_image'] ?>" alt="user profile photo" /></div>
                                <div class="col friend-info">
                                    <h4 class="m-0">
                                        <?= $row['name']; ?>
                                    </h4>
                                </div>
                            </li>

                        <?php } ?>
                    <?php } ?>
                </ul>
                <div class="chat_box_message" style="display: none;">
                </div>
                <div class="chat_box" style="display: none;">
                    <div class=" d-flex justify-content-start align-items-center p-3  border-0">
                        <img class="rounded-circle" src="uploads/<?= $profile_image; ?>" alt=""
                            style="width: 40px; height: 100%;">
                        <input type="text" class="form-control form-control-lg ms-1" placeholder="Type message">
                        <a class="ms-1 text-white" href="#!"><i class="fas fa-paperclip"></i></a>
                        <a class="ms-3 text-white" href="#!"><i class="fas fa-smile"></i></a>
                        <button class="ms-3 text-black chat-send-btn" disabled><i class="fas fa-paper-plane"></i></button>
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