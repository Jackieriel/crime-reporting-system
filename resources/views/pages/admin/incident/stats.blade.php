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


    {{-- @foreach ($categories as $category)
        @php
            $cat = $category->category_name 
        @endphp
        <ul>
            <li>
                {{ $cat}} : 
                {{ $category->incidents->count() }}
            </li>
        </ul>



    @endforeach --}}

    {{-- {{ $var }} --}}

    <script type="text/javascript">
    
    var app = @json($var);
    var app2 = @json($var2);
   
    // document.write(app);


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
                    // left: '3%',
                    // right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    data: [
                      app
                    ],
                    axisTick: {
                        alignWithLabel: true
                    }
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                    name: 'Total Crime Incident',
                    type: 'bar',
                    barWidth: '5%',
                    // barWidth: '20%',
                    data: [
                        app2
                    ]
                }]
            });
        }

    </script>
    
<span class="rotate">TESTING</span>

<style>
    .rotate{
        transform: rotateY(130deg);
        color:blueviolet;
    }
</style>

@endsection
