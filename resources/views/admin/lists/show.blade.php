@extends('adminlte::page')

@section('title', 'Verzendlijsten')

@section('content_header')
    <h1>Verzendlijsten beheren</h1>
@stop

@section('content')
    <a href="{{ route('admin.newsletters.lists.index') }}" class="btn btn-primary margin-bottom">
        <i class="fa fa-arrow-left"></i> Terug
    </a>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Lid toevoegen</h3>
        </div>
        <div class="box-body">
            <form method="post"
                  action="{{ route('admin.newsletters.lists.members.store', $list) }}"
                  style="display: flex; margin-bottom: 1em"
            >
                {{ csrf_field() }}
                <input type="text"
                       name="email"
                       value="{{ old('email', '') }}"
                       class="form-control"
                       placeholder="E-mailadres"
                       style="margin-right: 10px;"
                >
                <input type="text"
                       name="name"
                       value="{{ old('name', '') }}"
                       class="form-control"
                       placeholder="Naam (optioneel)"
                       style="margin-right: 10px;"
                >
                <button type="submit" class="btn btn-success">Toevoegen</button>
            </form>
            @if(count($errors))
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                {{ $list->name }}
                <a href="{{ route('admin.newsletters.lists.edit', $list) }}"
                   class="btn btn-xs btn-default"
                   title="Naam en beschrijving aanpassen"
                   data-toggle="tooltip"
                ><i class="fa fa-edit"></i></a>
                <br>
                <small>{{ $list->description }}</small>
            </h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin table-striped">
                    <thead>
                    <tr>
                        <th>E-mailadres</th>
                        <th>Naam</th>
                        <th>Ingeschreven</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>{{ $member->address }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->subscribed ? 'Ja' : 'Nee' }}</td>
                            <td>
                                <form method="post"
                                      action="{{ route('admin.newsletters.lists.members.destroy', [$list, $member]) }}"
                                      style="display: inline"
                                >
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $members->links() }}
            </div>
        </div>
    </div>
@endsection