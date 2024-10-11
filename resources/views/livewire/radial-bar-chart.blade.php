    <div class="h-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

        <div class="flex justify-between mb-3">
            <div class="flex justify-center items-center">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Occupation</h5>
                {{-- * info icon --}}
                {{-- <svg data-popover-target="chart-info" data-popover-placement="bottom"
                    class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                </svg> --}}
                {{-- * infos shown when hover to icon --}}
                {{-- <div data-popover id="chart-info" role="tooltip"
                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                    <div class="p-3 space-y-2">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth - Incremental</h3>
                        <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should
                            have a
                            growing trend, as stagnating chart signifies a significant decrease of community activity.
                        </p>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                        <p>For each date bucket, the all-time volume of activities is calculated. This means that
                            activities
                            in period n contain all activities up to period n, plus the activities generated by your
                            community in period.</p>
                        <a href="#"
                            class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read
                            more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg></a>
                    </div>
                    <div data-popper-arrow></div>
                </div> --}}
            </div>
            {{-- * button to download CSV --}}
            {{-- <div>
                <button type="button" data-tooltip-target="data-tooltip" data-tooltip-placement="bottom"
                    class="hidden sm:inline-flex items-center justify-center text-gray-500 w-8 h-8 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm"><svg
                        class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 16 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                    </svg><span class="sr-only">Download data</span>
                </button>
                <div id="data-tooltip" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Download CSV
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div> --}}
        </div>

        {{-- ! color names --}}
        {{-- <div>
            <div class="flex" id="devices">
                <div class="flex items-center me-4">
                    <input id="desktop" type="checkbox" value="desktop"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="desktop"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Desktop</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="tablet" type="checkbox" value="tablet"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="tablet"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tablet</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="mobile" type="checkbox" value="mobile"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="mobile"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mobile</label>
                </div>
            </div>
        </div> --}}

        <!-- Donut Chart -->
        <div id="radial-chart"></div>


    </div>



    <script>
        let radial_chart;
        document.addEventListener('DOMContentLoaded', function() {
            options = getRadialOptions(@json($occupation));
            radial_chart = new ApexCharts(document.querySelector("#radial-chart"), options);

            radial_chart.render();
        });


        let getRadialOptions = (data) => {
            return {
                colors: ['#EB6970'],
                chart: {
                    height: 280,
                    width: "100%",
                    type: "radialBar"
                },
                series: [data],
                plotOptions: {
                    radialBar: {
                        hollow: {
                            // margin: 15,
                            size: "60%"
                        },

                        dataLabels: {
                            // showOn: "always",
                            name: {
                                // offsetY: 0,
                                // show: true,
                                // color: "#888",
                                // fontSize: "13px"
                            },
                            value: {
                                offsetY: -5,
                                show: true,
                                fontSize: "18px",
                                color: "#697077",
                                fontFamily: "Inter, sans-serif",
                            }
                        }
                    }
                },

                stroke: {
                    lineCap: "round",
                },
                labels: [""]
            }
        };
    </script>

    @script
        <script>
            $wire.on('radial-update', (radial_data) => {
                // console.log("radial-update data :", radial_data[0]);
                const r_data = radial_data[0];
                radial_chart.updateOptions(getRadialOptions(r_data), animate = true, redrawPaths = false,
                    updateSyncedCharts = false);
            });
        </script>
    @endscript
