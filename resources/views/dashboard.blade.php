<?php 
    use App\Models\Cuenta;
    $saldos = Cuenta::where('user_id', Auth::user()->id)->get();
    foreach ($saldos as $saldo) {
        if ($saldo['cuentaType'] == 1) {
            $saldo['cuentaType']= "Corriente";
        }else{
            $saldo['cuentaType']= "Ahorro";
        }
        $puntos[] = ['name' => $saldo['cuentaType'], 'y' => floatval($saldo['availableBalance'])];
        $data = json_encode($puntos);
    }
?>

<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div id="container"></div>
    </div>

    <script src="{{asset('js/grafica.js')}}"></script>
    <script>
        (function (H) {
            H.seriesTypes.pie.prototype.animate = function (init) {
                const series = this,
                    chart = series.chart,
                    points = series.points,
                    {
                        animation
                    } = series.options,
                    {
                        startAngleRad
                    } = series;

                function fanAnimate(point, startAngleRad) {
                    const graphic = point.graphic,
                        args = point.shapeArgs;

                    if (graphic && args) {

                        graphic
                            // Set inital animation values
                            .attr({
                                start: startAngleRad,
                                end: startAngleRad,
                                opacity: 1
                            })
                            // Animate to the final position
                            .animate({
                                start: args.start,
                                end: args.end
                            }, {
                                duration: animation.duration / points.length
                            }, function () {
                                // On complete, start animating the next point
                                if (points[point.index + 1]) {
                                    fanAnimate(points[point.index + 1], args.end);
                                }
                                // On the last point, fade in the data labels, then
                                // apply the inner size
                                if (point.index === series.points.length - 1) {
                                    series.dataLabelsGroup.animate({
                                        opacity: 1
                                    },
                                    void 0,
                                    function () {
                                        points.forEach(point => {
                                            point.opacity = 1;
                                        });
                                        series.update({
                                            enableMouseTracking: true
                                        }, false);
                                        chart.update({
                                            plotOptions: {
                                                pie: {
                                                    innerSize: '40%',
                                                    borderRadius: 8
                                                }
                                            }
                                        });
                                    });
                                }
                            });
                    }
                }

                if (init) {
                    // Hide points on init
                    points.forEach(point => {
                        point.opacity = 0;
                    });
                } else {
                    fanAnimate(points[0], startAngleRad);
                }
            };
        }(Highcharts));

        Highcharts.chart('container', {
            chart: {
                type: 'pie',
                backgroundColor: 'transparent'
            },
            
            title: {
                text: 'Saldo Total',
                style: {
                color:'#f0f0f0',
                },
            },
            subtitle: {
                text: 'U lala que platuo',
                style: {
                color:'#f0f0f0',
                },
            },
            tooltip: {
                headerFormat: '',
                pointFormat:
                    '<span style="color:{point.color}">\u25cf</span> ' +
                    '{point.name}: <b>${point.y:,.2f}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    borderWidth: 2,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>${point.y:,.2f}',
                        distance: 20
                    }
                }
            },
            series: [{
                // Disable mouse tracking on load, enable after custom animation
                enableMouseTracking: false,
                animation: {
                    duration: 2000
                },
                colorByPoint: true,
                data: <?= $data?>
            }]
        });

    </script>
</x-layouts.app>