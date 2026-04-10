<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('locations')->truncate();

        // Configuración de grilla
        $width = 140;  // 120px + 20px margen
        $height = 100; // 80px + 20px margen
        $cols = 6;     // Máquinas por fila

        // Definición de sectores (X inicial, Y inicial)
        $offsets = [
            'ARMADO'         => ['x' => 100,  'y' => 100],
            'SEMIELABORADOS' => ['x' => 1000, 'y' => 100],
            'TALONES'        => ['x' => 100,  'y' => 800],
            'VULCANIZADO'    => ['x' => 1000, 'y' => 800],
            'BANBURY'        => ['x' => 1900, 'y' => 100],
            'CONTROL FINAL'  => ['x' => 1900, 'y' => 700],
            'MOTO'           => ['x' => 100,  'y' => 1500],
            'OTROS'          => ['x' => 1000, 'y' => 1500],
        ];

        $counts = []; // Para trackear la posición dentro de cada área

        $data = [
            ['id' => 1158, 'area' => 'ARMADO', 'name' => 'A70-01'],
            ['id' => 1159, 'area' => 'ARMADO', 'name' => 'A70-F2'],
            ['id' => 1160, 'area' => 'ARMADO', 'name' => 'A70-F1'],
            ['id' => 1161, 'area' => 'ARMADO', 'name' => 'A70-F3'],
            ['id' => 1162, 'area' => 'ARMADO', 'name' => 'A70-F4'],
            ['id' => 1163, 'area' => 'ARMADO', 'name' => 'A70-F5'],
            ['id' => 1170, 'area' => 'ARMADO', 'name' => '3L8 C04'],
            ['id' => 1171, 'area' => 'ARMADO', 'name' => '3L8 C01'],
            ['id' => 1172, 'area' => 'ARMADO', 'name' => '3L8 C11'],
            ['id' => 1173, 'area' => 'ARMADO', 'name' => '3L8 C02'],
            ['id' => 1174, 'area' => 'ARMADO', 'name' => 'AF69 01'],
            ['id' => 1175, 'area' => 'ARMADO', 'name' => 'TR20-F5'],
            ['id' => 1176, 'area' => 'ARMADO', 'name' => 'TR20-F3'],
            ['id' => 1177, 'area' => 'ARMADO', 'name' => '3L8-AT05'],
            ['id' => 1178, 'area' => 'ARMADO', 'name' => '3L8-AT09'],
            ['id' => 1179, 'area' => 'ARMADO', 'name' => 'A70-14'],
            ['id' => 1185, 'area' => 'ARMADO', 'name' => '3L8-AT07'],
            ['id' => 1188, 'area' => 'ARMADO', 'name' => 'A70-11'],
            ['id' => 1189, 'area' => 'ARMADO', 'name' => 'A70-26'],
            ['id' => 1190, 'area' => 'ARMADO', 'name' => 'A70-24'],
            ['id' => 1192, 'area' => 'ARMADO', 'name' => '3L8 C03'],
            ['id' => 1194, 'area' => 'ARMADO', 'name' => 'A70-06'],
            ['id' => 1195, 'area' => 'ARMADO', 'name' => '3L8 C05'],
            ['id' => 1196, 'area' => 'ARMADO', 'name' => 'A70-33'],
            ['id' => 1197, 'area' => 'ARMADO', 'name' => '3L8 C10'],
            ['id' => 1199, 'area' => 'ARMADO', 'name' => 'TR10-1'],
            ['id' => 1214, 'area' => 'ARMADO', 'name' => '3L8-AT03'],
            ['id' => 1215, 'area' => 'ARMADO', 'name' => '3L8-AT06'],
            ['id' => 1220, 'area' => 'ARMADO', 'name' => '3L8-AT01'],
            ['id' => 1221, 'area' => 'ARMADO', 'name' => '3L8-AT02'],
            ['id' => 1222, 'area' => 'ARMADO', 'name' => '3L8-AT04'],
            ['id' => 1223, 'area' => 'ARMADO', 'name' => '3L8-AT10'],
            ['id' => 1225, 'area' => 'ARMADO', 'name' => '3L8-AT11'],
            ['id' => 1226, 'area' => 'ARMADO', 'name' => 'A70-31'],
            ['id' => 1227, 'area' => 'ARMADO', 'name' => 'A70-28'],
            ['id' => 1228, 'area' => 'ARMADO', 'name' => 'A70-29'],
            ['id' => 1229, 'area' => 'ARMADO', 'name' => '3L8 C08'],
            ['id' => 1230, 'area' => 'ARMADO', 'name' => 'AF69 02'],
            ['id' => 1231, 'area' => 'ARMADO', 'name' => 'A70-12'],
            ['id' => 1233, 'area' => 'ARMADO', 'name' => 'A70-23'],
            ['id' => 1234, 'area' => 'ARMADO', 'name' => 'A70-02'],
            ['id' => 1235, 'area' => 'ARMADO', 'name' => 'A70-09'],
            ['id' => 1236, 'area' => 'ARMADO', 'name' => 'A70-13'],
            ['id' => 1237, 'area' => 'ARMADO', 'name' => 'A70-16'],
            ['id' => 1238, 'area' => 'ARMADO', 'name' => 'A70-27'],
            ['id' => 1239, 'area' => 'ARMADO', 'name' => 'A70-19'],
            ['id' => 1240, 'area' => 'ARMADO', 'name' => 'A70-25'],
            ['id' => 1241, 'area' => 'ARMADO', 'name' => 'TR20-1'],
            ['id' => 1242, 'area' => 'ARMADO', 'name' => 'TR20-3'],
            ['id' => 1243, 'area' => 'ARMADO', 'name' => 'FS480-1'],
            ['id' => 1244, 'area' => 'ARMADO', 'name' => 'FS650-1'],
            ['id' => 1245, 'area' => 'ARMADO', 'name' => '3L8 C06'],
            ['id' => 1247, 'area' => 'ARMADO', 'name' => '3L8 C07'],
            ['id' => 1249, 'area' => 'ARMADO', 'name' => 'A70-32'],
            ['id' => 1250, 'area' => 'ARMADO', 'name' => 'A70-34'],
            ['id' => 1257, 'area' => 'ARMADO', 'name' => 'TR10-2'],
            ['id' => 1259, 'area' => 'ARMADO', 'name' => 'GUA ARM'],
            ['id' => 1264, 'area' => 'ARMADO', 'name' => 'A70-F6'],
            ['id' => 1265, 'area' => 'ARMADO', 'name' => 'TR20-F2'],
            ['id' => 1266, 'area' => 'ARMADO', 'name' => 'TR20-F4'],
            ['id' => 1267, 'area' => 'ARMADO', 'name' => 'TR20-F6'],
            ['id' => 1268, 'area' => 'ARMADO', 'name' => 'AF480-02'],
            ['id' => 1269, 'area' => 'ARMADO', 'name' => '3L8C09'],
            ['id' => 1298, 'area' => 'ARMADO', 'name' => 'MONITOREO'],
            ['id' => 1307, 'area' => 'ARMADO', 'name' => 'GUA ARM2'],
            ['id' => 1315, 'area' => 'ARMADO', 'name' => 'TR10-3'],
            ['id' => 1676, 'area' => 'ARMADO', 'name' => 'TR20-F1'],
            ['id' => 1679, 'area' => 'ARMADO', 'name' => '3L8 C12'],
            ['id' => 1716, 'area' => 'ARMADO', 'name' => 'A70-F7'],
            ['id' => 1717, 'area' => 'ARMADO', 'name' => 'TR20-F7'],
            ['id' => 1720, 'area' => 'ARMADO', 'name' => 'A70-F8'],
            ['id' => 1721, 'area' => 'ARMADO', 'name' => 'TR20-F8'],
            ['id' => 1787, 'area' => 'ARMADO', 'name' => 'ARM GEST'],
            
            // SEMIELABORADOS
            ['id' => 1164, 'area' => 'SEMIELABORADOS', 'name' => 'CAL TRI'],
            ['id' => 1166, 'area' => 'SEMIELABORADOS', 'name' => 'KAMPF 2'],
            ['id' => 1180, 'area' => 'SEMIELABORADOS', 'name' => 'TRIPLEX'],
            ['id' => 1181, 'area' => 'SEMIELABORADOS', 'name' => 'RECUP VZ'],
            ['id' => 1182, 'area' => 'SEMIELABORADOS', 'name' => 'TPCS'],
            ['id' => 1183, 'area' => 'SEMIELABORADOS', 'name' => 'TTM 4'],
            ['id' => 1184, 'area' => 'SEMIELABORADOS', 'name' => 'TTM 3'],
            ['id' => 1186, 'area' => 'SEMIELABORADOS', 'name' => '200+120'],
            ['id' => 1191, 'area' => 'SEMIELABORADOS', 'name' => '200+ 120E'],
            ['id' => 1198, 'area' => 'SEMIELABORADOS', 'name' => 'KAMPF 1'],
            ['id' => 1200, 'area' => 'SEMIELABORADOS', 'name' => 'BERSTOFF'],
            ['id' => 1201, 'area' => 'SEMIELABORADOS', 'name' => '6+6E'],
            ['id' => 1248, 'area' => 'SEMIELABORADOS', 'name' => 'LINER'],
            ['id' => 1251, 'area' => 'SEMIELABORADOS', 'name' => 'LISTINO'],
            ['id' => 1258, 'area' => 'SEMIELABORADOS', 'name' => 'RECUP'],
            ['id' => 1260, 'area' => 'SEMIELABORADOS', 'name' => 'CAL ME 2'],
            ['id' => 1261, 'area' => 'SEMIELABORADOS', 'name' => 'CAL ME 1'],
            ['id' => 1270, 'area' => 'SEMIELABORADOS', 'name' => 'BANDINA'],
            ['id' => 1280, 'area' => 'SEMIELABORADOS', 'name' => 'CAL TEX'],
            ['id' => 1282, 'area' => 'SEMIELABORADOS', 'name' => '6+6'],
            ['id' => 1283, 'area' => 'SEMIELABORADOS', 'name' => '6+6 PLC'],
            ['id' => 1284, 'area' => 'SEMIELABORADOS', 'name' => 'TPCS P'],
            ['id' => 1285, 'area' => 'SEMIELABORADOS', 'name' => 'TRIPLEX'],
            ['id' => 1297, 'area' => 'SEMIELABORADOS', 'name' => 'TTM 2'],
            ['id' => 1302, 'area' => 'SEMIELABORADOS', 'name' => 'BAND TV'],
            ['id' => 1310, 'area' => 'SEMIELABORADOS', 'name' => 'GUA SEMI'],
            ['id' => 1316, 'area' => 'SEMIELABORADOS', 'name' => 'CAP BAN'],
            ['id' => 1321, 'area' => 'SEMIELABORADOS', 'name' => 'FISC HER'],
            ['id' => 1528, 'area' => 'SEMIELABORADOS', 'name' => 'RECUP JAU '],
            ['id' => 1788, 'area' => 'SEMIELABORADOS', 'name' => 'SEMI GEST'],

            // TALONES
            ['id' => 1165, 'area' => 'TALONES', 'name' => 'MONO 11'],
            ['id' => 1167, 'area' => 'TALONES', 'name' => 'TRAF AP6'],
            ['id' => 1168, 'area' => 'TALONES', 'name' => 'MONO 07'],
            ['id' => 1187, 'area' => 'TALONES', 'name' => 'COR 2'],
            ['id' => 1193, 'area' => 'TALONES', 'name' => 'BIMZ'],
            ['id' => 1211, 'area' => 'TALONES', 'name' => 'MONO 10'],
            ['id' => 1212, 'area' => 'TALONES', 'name' => 'MONO 08'],
            ['id' => 1213, 'area' => 'TALONES', 'name' => 'MONO 14'],
            ['id' => 1246, 'area' => 'TALONES', 'name' => 'COR FPA'],
            ['id' => 1304, 'area' => 'TALONES', 'name' => 'LAN 01'],
            ['id' => 1305, 'area' => 'TALONES', 'name' => 'LAN 02'],
            ['id' => 1306, 'area' => 'TALONES', 'name' => 'LAN 03'],
            ['id' => 1311, 'area' => 'TALONES', 'name' => 'MONO 06'],
            ['id' => 1312, 'area' => 'TALONES', 'name' => 'MONO 11'],
            ['id' => 1319, 'area' => 'TALONES', 'name' => 'TAL GES'],
            ['id' => 1796, 'area' => 'TALONES', 'name' => 'COR BAR'],

            // VULCANIZADO
            ['id' => 1206, 'area' => 'VULCANIZADO', 'name' => 'VZ GA1'],
            ['id' => 1207, 'area' => 'VULCANIZADO', 'name' => 'VZ GA2'],
            ['id' => 1208, 'area' => 'VULCANIZADO', 'name' => 'VZ GA3'],
            ['id' => 1209, 'area' => 'VULCANIZADO', 'name' => 'VZ GA4'],
            ['id' => 1210, 'area' => 'VULCANIZADO', 'name' => 'VZ GA5'],
            ['id' => 1219, 'area' => 'VULCANIZADO', 'name' => 'VZ GUA'],
            ['id' => 1255, 'area' => 'VULCANIZADO', 'name' => 'VZ GUA'],
            ['id' => 1263, 'area' => 'VULCANIZADO', 'name' => 'VZ C.P.'],
            ['id' => 1677, 'area' => 'VULCANIZADO', 'name' => 'VZ 1°P 1'],
            ['id' => 1678, 'area' => 'VULCANIZADO', 'name' => 'VZ 1°P 2'],

            // BANBURY
            ['id' => 1216, 'area' => 'BANBURY', 'name' => 'BY2 PLC'],
            ['id' => 1256, 'area' => 'BANBURY', 'name' => 'BY GEST 1'],
            ['id' => 1281, 'area' => 'BANBURY', 'name' => 'BY ELEC'],
            ['id' => 1292, 'area' => 'BANBURY', 'name' => 'BY GUA'],
            ['id' => 1293, 'area' => 'BANBURY', 'name' => 'BY3 PAN'],
            ['id' => 1294, 'area' => 'BANBURY', 'name' => 'BY3 PLC'],
            ['id' => 1295, 'area' => 'BANBURY', 'name' => 'BY1 PAN'],
            ['id' => 1296, 'area' => 'BANBURY', 'name' => 'BY2 PAN'],
            ['id' => 1313, 'area' => 'BANBURY', 'name' => 'BY GUA '],
            ['id' => 1317, 'area' => 'BANBURY', 'name' => 'BY3 PAN'],
            ['id' => 1318, 'area' => 'BANBURY', 'name' => 'BY4 PLC'],
            ['id' => 1330, 'area' => 'BANBURY', 'name' => 'BY1 PLC'],
            ['id' => 1675, 'area' => 'BANBURY', 'name' => 'BY GEST 2'],
            ['id' => 1768, 'area' => 'BANBURY', 'name' => 'BY CAL'],

            // CONTROL FINAL
            ['id' => 1262, 'area' => 'CONTROL FINAL', 'name' => 'CF GUA'],
            ['id' => 1276, 'area' => 'CONTROL FINAL', 'name' => 'AKRO 1'],
            ['id' => 1289, 'area' => 'CONTROL FINAL', 'name' => 'CF D702'],
            ['id' => 1290, 'area' => 'CONTROL FINAL', 'name' => 'CF D701'],
            ['id' => 1291, 'area' => 'CONTROL FINAL', 'name' => 'AKRO 2'],
            ['id' => 1299, 'area' => 'CONTROL FINAL', 'name' => 'CF SUPER'],
            ['id' => 1300, 'area' => 'CONTROL FINAL', 'name' => 'CF D703'],
            ['id' => 1301, 'area' => 'CONTROL FINAL', 'name' => 'CF GUA'],
            ['id' => 1308, 'area' => 'CONTROL FINAL', 'name' => 'CF SERV'],
            ['id' => 1309, 'area' => 'CONTROL FINAL', 'name' => 'CF I.M.'],
            ['id' => 1320, 'area' => 'CONTROL FINAL', 'name' => 'CF JAU'],
            ['id' => 1322, 'area' => 'CONTROL FINAL', 'name' => 'CF UNIF'],
            ['id' => 1325, 'area' => 'CONTROL FINAL', 'name' => 'AKRO 3'],
            ['id' => 1326, 'area' => 'CONTROL FINAL', 'name' => 'AKRO 4'],
            ['id' => 1327, 'area' => 'CONTROL FINAL', 'name' => 'AKRO 5'],
            ['id' => 1332, 'area' => 'CONTROL FINAL', 'name' => 'CF I.P.'],
            ['id' => 1333, 'area' => 'CONTROL FINAL', 'name' => 'CF CASA'],
            ['id' => 1626, 'area' => 'CONTROL FINAL', 'name' => 'RECT 6'],
            ['id' => 1640, 'area' => 'CONTROL FINAL', 'name' => 'RECT 3'],
            ['id' => 1695, 'area' => 'CONTROL FINAL', 'name' => 'RAY X'],
            ['id' => 1763, 'area' => 'CONTROL FINAL', 'name' => 'EST CMS'],

            // MOTO
            ['id' => 1169, 'area' => 'MOTO', 'name' => 'MOT CM2'],
            ['id' => 1202, 'area' => 'MOTO', 'name' => 'MOT CM3'],
            ['id' => 1203, 'area' => 'MOTO', 'name' => 'MOT CM4'],
            ['id' => 1204, 'area' => 'MOTO', 'name' => 'MOT C.P.'],
            ['id' => 1205, 'area' => 'MOTO', 'name' => 'MOT CM1'],
            ['id' => 1252, 'area' => 'MOTO', 'name' => 'MOT 2° C'],
            ['id' => 1277, 'area' => 'MOTO', 'name' => 'CM TEAM'],
            ['id' => 1278, 'area' => 'MOTO', 'name' => 'CM CALI'],
            ['id' => 1279, 'area' => 'MOTO', 'name' => 'VEJIGAS'],

            // OTROS
            ['id' => 1217, 'area' => 'COMPUESTOS', 'name' => 'COM AUT'],
            ['id' => 1218, 'area' => 'COMPUESTOS', 'name' => 'COMP 2'],
            ['id' => 1253, 'area' => 'COMPUESTOS', 'name' => 'COMP 1'],
            ['id' => 1254, 'area' => 'COMPUESTOS', 'name' => 'COMP 3'],
            ['id' => 1271, 'area' => 'CONTROL VISIVO', 'name' => 'VISI AM1'],
            ['id' => 1272, 'area' => 'CONTROL VISIVO', 'name' => 'VISI AM2'],
            ['id' => 1273, 'area' => 'CONTROL VISIVO', 'name' => 'VISI 2°C'],
            ['id' => 1274, 'area' => 'CONTROL VISIVO', 'name' => 'VISI R.MA'],
            ['id' => 1275, 'area' => 'CONTROL VISIVO', 'name' => 'VIS MAT'],
            ['id' => 1286, 'area' => 'CONTROL VISIVO', 'name' => 'VISI R.ME'],
            ['id' => 1314, 'area' => 'CONTROL VISIVO', 'name' => 'VIS BAL'],
            ['id' => 1324, 'area' => 'CONTROL VISIVO', 'name' => 'VIS TL'],
            ['id' => 1331, 'area' => 'CONTROL VISIVO', 'name' => 'VIS DAT'],
            ['id' => 1336, 'area' => 'LABORATORIO', 'name' => 'LAB'],
            ['id' => 1674, 'area' => 'CONTROL VISIVO', 'name' => 'VISI 2°C'],
            ['id' => 1680, 'area' => 'CONTROL VISIVO', 'name' => 'VISI R.JA'],
            ['id' => 1698, 'area' => 'LOGISTICA', 'name' => 'SGATE03'],
            ['id' => 1699, 'area' => 'LOGISTICA', 'name' => 'SGATE01'],
            ['id' => 1700, 'area' => 'LOGISTICA', 'name' => 'SGATE02'],
            ['id' => 1778, 'area' => 'OTROS', 'name' => 'BALANZA PATIO'],
            ['id' => 1789, 'area' => 'HSE', 'name' => 'HSE UPN'],
        ];

        $insertData = []; // Creamos un array vacío para acumular

        foreach ($data as $item) {
            $area = $item['area'];
            $sector = $offsets[$area] ?? $offsets['OTROS'];
            
            $index = $counts[$area] ?? 0;
            $row = floor($index / $cols);
            $col = $index % $cols;

            // En lugar de crear uno por uno, lo metemos al array
            $insertData[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'area' => $area,
                'is_monitored' => false,
                'x' => $sector['x'] + ($col * $width),
                'y' => $sector['y'] + ($row * $height),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $counts[$area] = $index + 1;
        }

        // Insertamos TODO de un solo golpe (mucho más rápido y seguro)
        Location::insert($insertData);
    }
}