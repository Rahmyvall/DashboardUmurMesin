@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-4">

                        <!-- Title -->
                        <h4 class="mb-4 fw-bold text-primary">
                            <i class="bi bi-tools"></i> {{ $title ?? 'Edit Maintenance' }}
                        </h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">

                                <!-- Machine -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Mesin <span class="text-danger">*</span></label>
                                    <select name="machine_id" class="form-control rounded-3" required>
                                        <option value="">-- Pilih Mesin --</option>
                                        @foreach ($machines as $machine)
                                            <option value="{{ $machine->id }}"
                                                {{ old('machine_id', $maintenance->machine_id) == $machine->id ? 'selected' : '' }}>
                                                {{ $machine->name }}
                                                @if ($machine->code)
                                                    ({{ $machine->code }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Maintenance Type -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Tipe Maintenance <span
                                            class="text-danger">*</span></label>
                                    <select name="maintenance_type" class="form-control rounded-3" required>
                                        <option value="preventive"
                                            {{ old('maintenance_type', $maintenance->maintenance_type) == 'preventive' ? 'selected' : '' }}>
                                            Preventive (Pencegahan)
                                        </option>
                                        <option value="corrective"
                                            {{ old('maintenance_type', $maintenance->maintenance_type) == 'corrective' ? 'selected' : '' }}>
                                            Corrective (Perbaikan)
                                        </option>
                                    </select>
                                </div>

                                <!-- Maintenance Date -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Tanggal Maintenance <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="maintenance_date" class="form-control rounded-3"
                                        value="{{ old('maintenance_date', $maintenance->maintenance_date->format('Y-m-d')) }}"
                                        required>
                                </div>

                                <!-- Technician -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Teknisi</label>
                                    <select name="technician_id" class="form-control rounded-3">
                                        <option value="">-- Pilih Teknisi (Opsional) --</option>
                                        @foreach ($technicians as $technician)
                                            <option value="{{ $technician->id }}"
                                                {{ old('technician_id', $maintenance->technician_id) == $technician->id ? 'selected' : '' }}>
                                                {{ $technician->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Cost -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Biaya (Rp)</label>
                                    <input type="number" name="cost" class="form-control rounded-3"
                                        value="{{ old('cost', $maintenance->cost) }}" placeholder="0" min="0"
                                        step="1000">
                                </div>

                                <!-- Description -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Deskripsi / Pekerjaan yang Dilakukan</label>
                                    <textarea name="description" class="form-control rounded-3" rows="3"
                                        placeholder="Jelaskan pekerjaan maintenance...">{{ old('description', $maintenance->description) }}</textarea>
                                </div>

                                <!-- Notes -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Catatan Tambahan</label>
                                    <textarea name="notes" class="form-control rounded-3" rows="2" placeholder="Catatan penting...">{{ old('notes', $maintenance->notes) }}</textarea>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('maintenance.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>

                                <button type="submit" class="btn btn-warning px-5">
                                    <i class="bi bi-save"></i> Update Maintenance
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
