<x-app-layout>
    <x-slot name="title">
        Rekomendasi Gaya Belajar Anak
    </x-slot>

    <x-slot name="head">
        <style>
            .red-border {
                border: 1px solid rgba(227, 39, 79, .8);
            }

            .green-border {
                border: 1px solid rgba(50, 179, 104, .8);
            }
        </style>
    </x-slot>

    <section class="row">

        {{-- chart section --}}
        <div class="col-md-12">
            <x-alert-error></x-alert-error>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.diagnosa') }}" method="post">
                    @csrf

                    @role('Admin')
                    <label for=""><b><i class="fas fa-user mr-1"></i> Nama</b></label>
                    <input type="text" class="form-control mb-3 w-50" name="nama">
                    @endrole

                    <p>Pilih Kebiasaan Anak.</p>

                    <label for=""><b><i class="fas fa-th mr-1"></i> Kebiasaan</b></label>
                    @foreach($gejala as $key => $value)
                        @php 
                        $mod = ($key + 1) % 2;
                        @endphp

                        @if($mod == 1)
                    <div class="row">
                        @endif
                        <div class="col-md-6">
                            <div class="d-flex align-items-center justify-content-between border mb-2 p-2">
                                <div>
                                    <span class="ml-2">{{ $value->nama }}</span>
                                </div>
                                <div>
                                    <select name="diagnosa[]" class="form-control form-control-sm red-border">
                                        <option value="{{ $value->id }}+-1">Sangat Tidak Yakin</option>
                                        <option value="{{ $value->id }}+-0.75">Tidak Yakin</option>
                                        <option value="{{ $value->id }}+-0.5">Cenderung Tidak Yakin</option>
                                        <option value="{{ $value->id }}+-0.25">Sedikit Tidak Yakin</option>
                                        <option value="{{ $value->id }}+0" selected>Tidak Tahu / Netral</option>
                                        <option value="{{ $value->id }}+0.25">Sedikit Yakin</option>
                                        <option value="{{ $value->id }}+0.5">Cenderung Yakin</option>
                                        <option value="{{ $value->id }}+0.75">Yakin</option>
                                        <option value="{{ $value->id }}+1">Sangat Yakin</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    @if($mod == 0)
                    </div>
                    @endif

                    @if($key + 1 == \App\Models\Gejala::count() && $mod != 0)
                    </div>
                    @endif
                        
                    @endforeach
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Cari Tahu Sekarang</button>
                    </div>
                </div>
            </form>
            </div>  
        </div>
    </section>

    <x-slot name="script">
        <script>
            $('button[type="submit"]').click(function() {
                $(this).attr('disabled')
            })

            $('select[name="diagnosa[]"]').on('change', function() {
                if(this.value == "") {
                    $(this).attr('class', 'form-control form-control-sm red-border')
                } else {
                    $(this).attr('class', 'form-control form-control-sm green-border')
                }
            })
        </script>
    </x-slot>
</x-app-layout>