@extends('layouts.frontend2')

@section('title')
    {{ $title }}
@endsection


@section('content')
    <div class="container">
        <div class="card">


            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (Auth::check())
                    <div class="card-header text-center text-uppercase">Statistics</div>
                    <div class="chart has-fixed-height" id="bars_basic"></div>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var bars_basic_element = document.getElementById('bars_basic');
        if (bars_basic_element) {
            var bars_basic = echarts.init(bars_basic_element);
            bars_basic.setOption({
                color: ['#3398DB'],
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    data: [@foreach ($crime_categories as $category)
         {{ $category->category_name }}
    @endforeach],
                    axisTick: {
                        alignWithLabel: true
                    }
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                    name: 'Total Products',
                    type: 'bar',
                    barWidth: '20%',
                    data: [
                        
                    ]
                }]
            });
        }

    </script>
{{ $rape }},
{{ $rubbery }},
{{ $assult }}
@endsection
