<!DOCTYPE html>
<html>
<head>
    <title>Boleta de Calificaciones</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; position: relative; }
        .header img { position: absolute; left: 0; top: 0; width: 100%; margin-bottom: 5% }
        .header h1 { margin: 0; padding-top: 50px; }
        .content { margin-top: 20px; }
        .info-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .info-table, .info-table th, .info-table td { border: 1px solid black; }
        .info-table th, .info-table td { padding: 10px; text-align: left; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid black; }
        .table th, .table td { padding: 10px; text-align: center; }
        .text-success { color: green; }
        .text-danger { color: red; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/header.png') }}" alt="Logo" height="50">
        <h1>Boleta de Calificaciones</h1>
    </div>
    <div class="content">
        <table class="info-table">
            <tr>
                <th>Nombre</th>
                <td>{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
                <th>Matrícula</th>
                <td>{{ $alumno->matricula }}</td>
            </tr>
            <tr>
                <th>Sexo</th>
                <td>{{ $alumno->sexo }}</td>
                <th>Grupo</th>
                <td>{{ $grupo->nombre }}</td>
            </tr>
            <tr>
                <th>Semestre</th>
                <td>{{ $alumno->semestre }}</td>
                <th>Especialidad</th>
                <td>{{ $alumno->especialidad }}</td>
            </tr>
        </table>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Primer Parcial</th>
                    <th>Segundo Parcial</th>
                    <th>Tercer Parcial</th>
                    <th>Final</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resultados as $resultado)
                    <tr>
                        <td class="textoG">{{ $resultado->materia->nombre }}</td>
                        <td class="textoG">{{ $resultado->parcial1 }}</td>
                        <td class="textoG">{{ $resultado->parcial2 }}</td>
                        <td class="textoG">{{ $resultado->parcial3 }}</td>
                        <td class="textoG">{{ $resultado->final }}</td>
                        <td class="{{ $resultado->final >= 70 ? 'text-success' : 'text-danger' }}">
                            {{ $resultado->final >= 70 ? 'Aprobado' : 'Reprobado' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>&copy; 2024 CECYTE 05 VILLA DE ETLA</p>
    </div>
</body>
</html>
