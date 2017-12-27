<div class="col-xs-2 col-sm-2 col-md-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
    <div class="form-group">
        <p><strong>Image: </strong></p>
        @if(isset($model->image))
            <img style="max-height: 67%; max-width: 67%" src="/images/{{ $model->image }}" />
        @endif
        {!! Form::file('image') !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
        <strong>Title:</strong>
        {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <strong>Author:</strong>
        {!! Form::text('author', null, array('placeholder' => 'Author','class' => 'form-control')) !!}
    </div>
    <div class="form-group" style="width: 25%;">
        <strong>Publication Date:</strong>
        {!! Form::date('publication_date', null, array('placeholder' => 'Publication Date','class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <strong>Public:</strong>
        {!! Form::hidden('public', 0) !!}
        {!! Form::checkbox('public') !!}
        <p class="text-muted">* Reflects whether this book is viewable to everyone.</p>
    </div>
</div>
<div class="col-xs-8 col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
    <div class="form-group">
        <strong>Description:</strong>
        {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
    </div>
</div>
<div class="col-xs-8 col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 text-right">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>