<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaporController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $siswa = Siswa::where('user_id', $user)->first();

        $angkatans = Angkatan::paginate(2);
        $angkatanNilais = [];

        foreach ($angkatans as $angkatan) {
            $nilais = Nilai::where('siswa_id', $siswa->id)
                            ->where('angkatan_id', $angkatan->id)
                            ->with('mapel')
                            ->get();

            $totalNilai = 0;
            $count = 0;
            foreach ($nilais as $nilai) {
                $average = ($nilai->tugas1 + $nilai->tugas2 + $nilai->tugas3 + $nilai->ujian) / 4;
                $nilai->average = $average;
                $totalNilai += $average;
                $count++;
            }

            $overallAverage = $count ? $totalNilai / $count : 0;
            $status = $overallAverage >= 70 ? 'Lulus' : 'Tidak Lulus';

            $angkatanNilais[] = [
                'angkatan' => $angkatan,
                'nilais' => $nilais,
                'overallAverage' => $overallAverage,
                'status' => $status
            ];
        }

        return view('siswa.pages.rapor', compact('siswa', 'angkatanNilais', 'angkatans'));
    }

    public function searching(Request $request)
    {
        $user = Auth::user()->id;
        $siswa = Siswa::where('user_id', $user)->first();
        $search = $request->input('search');

        $angkatans = Angkatan::where('class', 'like', '%' . $search . '%')->paginate(2);
        $angkatanNilais = [];

        foreach ($angkatans as $angkatan) {
            $nilais = Nilai::where('siswa_id', $siswa->id)
                            ->where('angkatan_id', $angkatan->id)
                            ->with('mapel')
                            ->get();

            $totalNilai = 0;
            $count = 0;
            foreach ($nilais as $nilai) {
                $average = ($nilai->tugas1 + $nilai->tugas2 + $nilai->tugas3 + $nilai->ujian) / 4;
                $nilai->average = $average;
                $totalNilai += $average;
                $count++;
            }

            $overallAverage = $count ? $totalNilai / $count : 0;
            $status = $overallAverage >= 70 ? 'Lulus' : 'Tidak Lulus';

            $angkatanNilais[] = [
                'angkatan' => $angkatan,
                'nilais' => $nilais,
                'overallAverage' => $overallAverage,
                'status' => $status
            ];
        }

        return view('siswa.pages.rapor', compact('siswa', 'angkatanNilais', 'angkatans', 'search'));
    }

    public function getAngkatanNilai($angkatanId)
    {
        $user = Auth::user()->id;
        $siswa = Siswa::where('user_id', $user)->first();

        $angkatan = Angkatan::find($angkatanId);
        $nilais = Nilai::where('siswa_id', $siswa->id)
                        ->where('angkatan_id', $angkatanId)
                        ->with('mapel')
                        ->get();

        $totalNilai = 0;
        $count = 0;
        foreach ($nilais as $nilai) {
            $average = ($nilai->tugas1 + $nilai->tugas2 + $nilai->tugas3 + $nilai->ujian) / 4;
            $nilai->average = $average;
            $totalNilai += $average;
            $count++;
        }

        $overallAverage = $count ? $totalNilai / $count : 0;
        $status = $overallAverage >= 70 ? 'Lulus' : 'Tidak Lulus';

        return response()->json([
            'angkatan' => $angkatan,
            'nilais' => $nilais,
            'overallAverage' => $overallAverage,
            'status' => $status
        ]);
    }

    public function raporAdmin()
    {
        $angkatans = Angkatan::paginate(4);
        $angkatanNilais = [];

        foreach ($angkatans as $angkatan) {
            $nilais = Nilai::where('angkatan_id', $angkatan->id)
                            ->with(['siswa', 'mapel'])
                            ->get()
                            ->groupBy('siswa_id');

            foreach ($nilais as $siswaId => $siswaNilais) {
                $totalNilai = 0;
                $count = 0;

                foreach ($siswaNilais as $nilai) {
                    $average = ($nilai->tugas1 + $nilai->tugas2 + $nilai->tugas3 + $nilai->ujian) / 4;
                    $nilai->average = $average;
                    $totalNilai += $average;
                    $count++;
                }

                $overallAverage = $count ? $totalNilai / $count : 0;
                $status = $overallAverage >= 70 ? 'Lulus' : 'Tidak Lulus';

                $angkatanNilais[] = [
                    'angkatan' => $angkatan,
                    'siswa' => $siswaNilais->first()->siswa,
                    'nilais' => $siswaNilais,
                    'overallAverage' => $overallAverage,
                    'status' => $status
                ];
            }
        }

        return view('siswa.pages.rapor_admin', compact('angkatanNilais', 'angkatans'));
    }

    public function searchingAdmin(Request $request)
    {
        $search = $request->get('search');
        
        if ($search) {
            $siswaQuery = Siswa::where('name', 'like', '%' . $search . '%');
            $siswaIds = $siswaQuery->pluck('id');

            $angkatans = Angkatan::paginate(4);
            $angkatanNilais = [];

            foreach ($angkatans as $angkatan) {
                $nilais = Nilai::whereIn('siswa_id', $siswaIds)
                                ->where('angkatan_id', $angkatan->id)
                                ->with(['siswa', 'mapel'])
                                ->get()
                                ->groupBy('siswa_id');

                foreach ($nilais as $siswaId => $siswaNilais) {
                    $totalNilai = 0;
                    $count = 0;

                    foreach ($siswaNilais as $nilai) {
                        $average = ($nilai->tugas1 + $nilai->tugas2 + $nilai->tugas3 + $nilai->ujian) / 4;
                        $nilai->average = $average;
                        $totalNilai += $average;
                        $count++;
                    }

                    $overallAverage = $count ? $totalNilai / $count : 0;
                    $status = $overallAverage >= 70 ? 'Lulus' : 'Tidak Lulus';

                    $angkatanNilais[] = [
                        'angkatan' => $angkatan,
                        'siswa' => $siswaNilais->first()->siswa,
                        'nilais' => $siswaNilais,
                        'overallAverage' => $overallAverage,
                        'status' => $status
                    ];
                }
            }
        } else {
            $angkatanNilais = [];
            $angkatans = Angkatan::paginate(2);
        }

        return view('siswa.pages.rapor_admin', compact('angkatanNilais', 'angkatans'));
    }

}
