@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все страницы</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-1 mb-3">
                    <a href="{{ route('admin.page.create') }}" class="btn btn-block btn-primary align-items-center">Добавить</a>
                </div>
            </div>
    @if ($roots->count())
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th width="45%">Наименование</th>
                <th width="45%">ЧПУ (англ.)</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach ($roots as $root)
                <tr>
                    <td>{{ $root->id }}</td>
                    <td><strong>{{ $root->name }}</strong></td>
                    <td>{{ $root->slug }}</td>
                    <td>
                        <a href="{{ route('admin.page.edit', ['page' => $root->id]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.page.destroy', ['page' => $root->id]) }}"
                              method="post" onsubmit="return confirm('Удалить эту страницу?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @foreach ($root->children as $child)
                    <tr>
                        <td>{{ $child->id }}</td>
                        <td>— {{ $child->name }}</td>
                        <td>{{ $child->slug }}</td>
                        <td>
                            <a href="{{ route('admin.page.edit', ['page' => $child->id]) }}">
                                <i class="far fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.page.destroy', ['page' => $child->id]) }}"
                                  method="post" onsubmit="return confirm('Удалить эту страницу?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i class="far fa-trash-alt text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    @endif
        </div>
    </section>
</div>
@endsection
