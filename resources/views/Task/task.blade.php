<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Budget</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Budget of {{Carbon\Carbon::now()->format('M')}} - {{Carbon\Carbon::now()->format('Y')}}</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create</a>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Tasks</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Total</h5>
                            <h6>{{ $totalbudget }}</h6>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Income</th>
                                            <th scope="col">Expense</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>{{ $incomestotal }}</td>
                                        <td>{{ $expenstotal }} - <span class="text-danger">{{ $percent }} %</span></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Income</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomes as $income)
                            <tr>
                                <td>{{ $income->id }}</td>
                                <td>{{ $income->description }}</td>
                                <td>{{ $income->number }}</td>
                                <td>
                                    <form action="{{ route('tasks.destroy',$income->id) }}" method="Post">
                                        <a class="btn btn-primary" href="{{ route('tasks.edit',$income->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Expenses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->number }}</td>
                                <td>
                                    <form action="{{ route('tasks.destroy',$expense->id) }}" method="Post">
                                        <a class="btn btn-primary" href="{{ route('tasks.edit',$expense->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- {!! $companies->links() !!} --}}
    </div>
</body>
</html>
