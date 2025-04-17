<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ID Card Print</title>
  <style>
    body {
  font-family: sans-serif;
  background: url("images/background.png") no-repeat center center fixed;
  background-size: cover;
  padding: 30px;
  text-align: center;
}

.print-container {
  display: flex;
  justify-content: center;
  gap: 50px;
  flex-wrap: wrap;
  margin-bottom: 20px;
}

.id-card {
  width:  60.452mm;
  height: 93.856mm;
  border: 2px solid #000;
  box-shadow: 0 0 5px rgba(0,0,0,0.5);
  background-color: white;
  overflow: hidden;
  position: relative;
}

.id-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

button {
  padding: 10px 20px;
  font-size: 16px;
  background-color: darkblue;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 6px;
}

button:hover {
  background-color: navy;
}

/* Print styles */
@media print {
  body {
    background: none;
    padding: 0;
  }

  button {
    display: none;
  }

  .print-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: nowrap;
    page-break-inside: avoid;
  }

  .id-card {
    box-shadow: none;
    border: none;
  }
}

  </style>
</head>
<body>
  <div class="print-container">
    <div class="id-card front">
      <img src="https://rzasc.com/uploads/certificate/Untitled-1_(1).png" alt="Front ID" />
    </div>
    <div class="id-card back">
      <img src="images/back.png" alt="Back ID" />
    </div>
  </div>

  <button onclick="window.print()">🖨️ Print ID Card</button>
</body>
</html>
