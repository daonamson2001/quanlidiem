<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct($flag = false)
    {
        $this->flag = $flag;
    }
    public function map($student): array
    {
        $date = date_create($student->ngaySinh);
        $data = [
            $student->idSV,
            $student->tenSV,
            $student->email,
            $student->gioiTinh == 1 ? "Nam" : "Nữ",
            date_format($date, "d/m/Y"),
            $student->idL,
            $student->queQuan,
        ];
        return $data;
    }
    public function headings(): array
    {
        if ($this->flag) return [
            'Mã sinh viên',
            'Họ tên',
            'Email',
            'Giới tính',
            'Ngày sinh',
            'Tên lớp',
            'Quê quán',
        ];
        return [
            'Mã sinh viên',
            'Họ tên',
            'Email',
            'Giới tính',
            'Ngày sinh',
            'Tên lớp',
            'Quê quán',
        ];
    }
    /**
     * 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->flag) return new Collection([]);
        return Student::all();
    }
}