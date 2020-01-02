<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_student_category">
                {{ csrf_field() }}
                @if ($StudentCategory)
                    <input type="hidden" name="id" value="{{ $StudentCategory->id }}">
                @endif
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{ $StudentCategory ? 'Edit Student Category' : 'Add Student Category' }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Student Category</label>
                        <input type="text" class="form-control" name="student_category" value="{{ $StudentCategory ? $StudentCategory->student_category : '' }}">
                        <div class="help-block text-red text-center" id="js-student-category">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Set as Current Student Category</label>
                        <select name="current_sy" id="current_sy" class="form-control">
                            <option value="1" {{ $StudentCategory ? ($StudentCategory->current == 0 ? 'selected' : '')  : '' }}>Yes</option>
                            <option value="0" {{ $StudentCategory ? ($StudentCategory->current == 0 ? 'selected' : '')  : 'selected' }}>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-current_sy">
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->