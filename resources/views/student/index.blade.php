@extends('layouts.default')
@section('title','学生列表')

@section('content')
<form method="post" action="{{ route('add') }}">
 {{ csrf_field() }}
 <div>
<label for="name" class="col-md-4 control-label">姓名</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
							
</div>

 <div>
<label for="name" class="col-md-4 control-label">性别</label>

                            <div class="col-md-6">
                                男<input id="sex" type="radio" class="form-control" name="sex" value="1" required autofocus>
                                女<input id="sex" type="radio" class="form-control" name="sex" value="0" required autofocus>
								未知<input id="sex" type="radio" class="form-control" name="sex" value="2" required autofocus>
                                @if ($errors->has('sex'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                @endif
                            </div>
							
</div>
 <div>
<label for="name" class="col-md-4 control-label">年龄</label>

                            <div class="col-md-6">
                                <input id="age" type="age" class="form-control" name="age" value="{{ old('age') }}" required autofocus>

                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
							
</div>

 <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    注册
                                </button>

                   
                            </div>
                        </div>
</form>
@stop