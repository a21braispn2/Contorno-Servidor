<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Gestión de Estudiantes</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f8fa;
        padding: 30px;
    }

    h1 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }

    th,
    td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #4a90e2;
        color: white;
    }

    tr:hover {
        background-color: #f2f2f2;
    }

    .form-container {
        margin-top: 30px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    input[type='text'],
    input[type='number'] {
        width: 100%;
        padding: 8px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    button {
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 5px;
    }

    .btn-add {
        background-color: #4caf50;
        color: white;
        width: 100%;
        margin-top: 10px;
    }

    .btn-update {
        background-color: #2196f3;
        color: white;
    }

    .btn-delete {
        background-color: #f44336;
        color: white;
    }
    </style>
</head>

<body>
    <h1>Lista de Estudiantes</h1>

    <table id="studentsTable">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="studentList">
            <!-- Se insertan dinámicamente -->
        </tbody>
    </table>

    <div class="form-container">
        <h3 id="formTitle">Añadir Estudiante</h3>
        <form id="studentForm">
            <input type="hidden" id="editIndex" />
            <label>DNI:</label>
            <input type="text" id="dni" required />
            <label>Nombre:</label>
            <input type="text" id="name" required />
            <label>Apellidos:</label>
            <input type="text" id="surname" required />
            <label>Edad:</label>
            <input type="number" id="age" required />
            <button type="submit" class="btn-add">Guardar</button>
        </form>
    </div>

    <script>
    const students = [];
    const form = document.getElementById('studentForm');
    const tableBody = document.getElementById('studentList');
    const editIndex = document.getElementById('editIndex');
    const formTitle = document.getElementById('formTitle');

    function renderList() {
        tableBody.innerHTML = '';
        students.forEach((student, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
          <td>${student.name}</td>
          <td>${student.surname}</td>
          <td>${student.dni}</td>
          <td>${student.age}</td>
          <td>
            <button class="btn-update" onclick="editStudent(${index})">Update</button>
            <button class="btn-delete" onclick="deleteStudent(${index})">Delete</button>
          </td>
        `;
            tableBody.appendChild(row);
        });
    }

    function deleteStudent(index) {
        if (confirm('¿Estás seguro de que quieres borrar este estudiante?')) {
            students.splice(index, 1);
            renderList();
        }
    }

    function editStudent(index) {
        const student = students[index];
        document.getElementById('dni').value = student.dni;
        document.getElementById('name').value = student.name;
        document.getElementById('surname').value = student.surname;
        document.getElementById('age').value = student.age;
        editIndex.value = index;
        formTitle.textContent = 'Actualizar Estudiante';
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const student = {
            dni: document.getElementById('dni').value,
            name: document.getElementById('name').value,
            surname: document.getElementById('surname').value,
            age: document.getElementById('age').value,
        };

        if (editIndex.value === '') {
            students.push(student);
        } else {
            students[editIndex.value] = student;
            editIndex.value = '';
            formTitle.textContent = 'Añadir Estudiante';
        }

        form.reset();
        renderList();
    });
    </script>
</body>

</html>