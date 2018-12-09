<!-- Modal -->
<div id="createSidebar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <form method="post" id="addSidebar">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b class="fa fa-navicon"></b> Добави меню</h4>
                </div>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Име на менюто</label>
                        <input type="text" name="title" id="title" placeholder="Discord server" class="form-control"
                               minlength="4">
                    </div>
                    <div class="form-group">
                        <label for="content">Съдържание</label>
                        <textarea name="content" id="content"></textarea>
                        <script>
                            CKEDITOR.replace('content');
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><b class="fa fa-times"></b>
                        Затвори
                    </button>
                    <button type="submit" class="btn btn-success btn-sm"><b class="fa fa-save"></b>
                        Запамети
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>