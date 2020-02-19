    <!-- New Events Modal -->
    <div class="modal" id="modal1">
        <div class="modal-dialog">
            <header class="modal-header">
                <h1>New Events/Promotions</h1>
                <button class="close-modal" aria-label="close modal" data-close>✕</button>
            </header>
            <form method="POST" enctype="multipart/form-data" action="promotion.php">
                <div class="modal-content">
                    <div class="form-group">
                        <p>
                            <label>Event: </label>
                            <input type="text" name="event" id="event" placeholder="Enter Event Title" value="<?php echo $row["name"]; ?>">
                        </p>
                    </div>
                    <div class="form-group">
                        <p>
                            <label>Alt-Description: </label>
                            <textarea rows="6" cols="40" placeholder="Optional Alt-Description" name="desc" id="desc"></textarea>
                        </p>
                    </div>
                    <div class="form-group">
                        <p>
                            Select files: <input type="file" name="myFile" id="myFile">
                        </p>
                    </div>
                </div>
                <footer class="modal-footer">
                    <button class="button button1 rightAlign" name="createEvent" type="submit">Create</button>
                </footer>
            </form>
        </div>
    </div>

    <!-- Change Events Status Modal -->
    <div class="modal" id="modal2">
        <div class="modal-dialog">
            <header class="modal-header">
                <h1>Change Events Status?</h1>
                <button class="close-modal" aria-label="close modal" data-close>✕</button>
            </header>
            <form method="POST" action="promotion.php">
                <div class="modal-content">
                    <p>Are you sure you want to change the current status?</p>
                </div>
                <footer class="modal-footer">
                    <!-- add a hidden input field to store ID for next step -->
                    <input type="hidden" name="id" value="" />
                    <a><button class="button button1 rightAlign" name="changeStatus" type="submit" value="<?php echo $row["id"]; ?>">Yes</button></a>
                    <button class="button button3 rightAlign" aria-label="close modal">Cancel</button> 
                </footer>
            </form>
        </div>
    </div>

    <!-- Delete Status Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <header class="modal-header">
                <h1>Delete Events?</h1>
                <button class="close-modal" aria-label="close modal" data-close>✕</button>
            </header>
            <form method="POST" action="promotion.php">
                <div class="modal-content">
                <input type="hidden" id="id_d" name="id" class="form-control">
                    <p>Are you sure you want to delete this event?</p>
                </div>
                <footer class="modal-footer">
                    <button class="button button1 rightAlign" name="deleteEvent" type="submit">Yes</button> 
                    <button class="button button3 rightAlign close-modal" aria-label="close modal" data-close>Cancel</button>
                </footer>
            </form>
        </div>
    </div>

    <!-- Modify Status Modal -->
    <div class="modal" id="modifyModal">
        <div class="modal-dialog">
            <header class="modal-header">
                <h1>Modify Events?</h1>
                <button class="close-modal" aria-label="close modal" data-close>✕</button>
            </header>
            <form method="POST" action="">
                <div class="modal-content">
                    <p>
                        <label>Event: </label>
                        <input type="text" name="event" placeholder="Enter Event Title">
                    </p>
                    <p>
                        <label>Alt-Description: </label>
                        <textarea rows="6" cols="40" placeholder="Optional Alt-Description"></textarea>
                    </p>
                    <p>
                        Select files: <input type="file" name="myFile">
                    </p>
                </div>
                <footer class="modal-footer">
                    <button class="button button1 rightAlign">Yes</button>
                    <button class="button button3 rightAlign close-modal" aria-label="close modal" data-close>Cancel</button> 
                </footer>
            </form>
        </div>
    </div>