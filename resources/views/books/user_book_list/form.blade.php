<div class="col-xs-8 col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
    <div class="form-group">
        <strong>Name:</strong>
        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
    </div>
</div>
<div class="col-xs-8 col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
    <div class="form-group">
        <strong>Description:</strong>
        {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
    </div>
</div>
<hr>
<div class="col-xs-8 col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
    <div class="form-group">
        <strong>Public:</strong>
        {!! Form::hidden('public', 0) !!}
        {!! Form::checkbox('public') !!}
        <p class="text-muted">* Reflects whether this book list is viewable to everyone.</p>
    </div>
</div>
<div class="col-xs-8 col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 text-right">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

