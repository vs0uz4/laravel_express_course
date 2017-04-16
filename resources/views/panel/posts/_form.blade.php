        <!-- Author Form Input -->
        <div class="form-group">
            {!! Form::label('author_id', 'Author:') !!}
            {!! Form::select('author_id', $authors, null, ['placeholder' => 'Select an author...', 'class' => 'form-control', 'required' => 'true']) !!}
        </div>

        <!-- Title Form Input -->
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'required' => 'true']) !!}
        </div>

        <!-- Content Form Input -->
        <div class="form-group">
            {!! Form::label('content', 'Content:') !!}
            {!! Form::textarea('content', null, ['class'=>'form-control textarea-resize-vertical', 'required' => 'true']) !!}
        </div>
