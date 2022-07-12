<div>
    <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <h2 class="text-white mb-5">Find Hero or Vilain With Name</h2>
                    <form class="form-signup" wire:submit.prevent="find">
                        <div class="row input-group-newsletter">
                            <div class="col"><input class="form-control" wire:model="name" type="text"
                                    placeholder="Enter Name" /></div>
                            <div class="col-auto"><button class="btn btn-primary" type="submit">Find</button></div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br><br>
            @if ($find == 1)
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5">
                        <div class="col-md-10 col-lg-8 mx-auto text-center">
                            @if ($data != null)
                                <h2 class="text-white mb-5">Result for : {{ $name }}</h2>
                                <table class="table text-white mb-5">
                                    <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Name</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value)
                                            <tr>
                                                <td><img src="{{ $value['image']['url'] }}" class="rounded-circle"
                                                        alt="pict" width="50" height="50"></td>
                                                <td>{{ $value['name'] }}</td>
                                                <td><button class="btn btn-sm btn-primary"
                                                        wire:click="detail({{ $value['id'] }})" data-toggle="modal"
                                                        data-target="#modalDetail">detail</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h2 class="text-white mb-5">Re enter Name Or click find</h2>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @if ($detail)
        <section class="projects-section bg-light" id="detail">
            <div class="container px-4 px-lg-5">
                <!-- Featured Project Row-->
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0"
                            src="{{ $detail['image']['url'] }}" alt="..." /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>Power</h4>
                            <canvas id="power" width="500" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @section('sc')
        <script>
            window.livewire.on('detail', (d) => {
                $('#detail')[0].scrollIntoView();
                let chartStatus = Chart.getChart("power");
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
                power = $('#power');
                const data = {
                    labels: d[0],
                    datasets: [{
                        label: 'My First Dataset',
                        data: d[1],
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    }]
                };
                const config = new Chart(power, {
                    type: 'radar',
                    data: data,
                    options: {
                        elements: {
                            line: {
                                borderWidth: 3
                            }
                        }
                    },
                });
            });

        </script>
    @endsection

</div>
