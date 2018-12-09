<!-- Modal -->
<div id="editNotification{{ $notification->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Редактиране на {{ $notification->title }}</h4>
            </div>
            <form method="post" id="update_notification">
                @csrf
                <input type="hidden" name="notification_id" id="notification_id" value="{{ $notification->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_notification_content">Съдържание</label>
                        <textarea name="new_notification_content"
                                  id="new_notification_content">{{ $notification->content }}</textarea>
                        <script>CKEDITOR.replace('new_notification_content')</script>
                    </div>
                    <div class="form-group">
                        <label for="category">Категория</label>
                        {!! Form::select(
                        'category',
                        [
                        'Категории' => $categories->pluck('name','id'),
                        'Съб-категории' => $subcategories->pluck('name','id'),
                        ],$notification->category_id,['placeholder'=>'Изберете категория','class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><b class="fa fa-times"></b>
                        Затвори
                    </button>
                    <button type="submit" class="btn btn-success btn-sm"><b
                                class="fa fa-refresh"></b>
                        Запамети
                    </button>
                </div>
            </form>
        </div>


    </div>
</div>