<?php
// === Basic Variables ===
$fullName = "Ananda Rossy Kurniawan";
$nickname = "Awan";
$currentDate = date("l, d F Y");

// === Data Types ===
$x = 2;
$y = 3.1415;
$state = True;
$names = ["Ananda", "Rossy", "Kurniawan"];

// === Arrays ===
$fruits = ["Apple", "Banana", "Cherry"];
$user = [
    "name" => $nickname,
    "email" => "awan@outlook.com",
    "role" => "IT"
];
$users = [
    ["name" => "Ananda", "role" => "admin"],
    ["name" => "Rossy", "role" => "user"],
    ["name" => "Kurniawan", "role" => "admin"]
];

// === Functions ===
function greet($name)
{
    return "Hello, $name!";
}

function greetUser($name = "Guest")
{
    return "Welcome, $name!";
}

function getProducts()
{
    return [
        ["name" => "Laptop", "price" => 1000],
        ["name" => "Mouse", "price" => 25]
    ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Demonstration - <?php echo $nickname; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #121212;
            color: #e0e0e0;
        }

        header,
        footer {
            background: #1f1f1f;
            color: white;
            padding: 15px;
            text-align: center;
            transition: background-color .25s ease, color .25s ease;
        }

        header:hover,
        footer:hover {
            background-color: #292929;
            color: #ffd700;
        }

        main {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }

        section {
            background: #1e1e1e;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(128, 128, 128, .1);
            transition: background-color .25s ease, box-shadow 0.25s ease;
        }

        section:hover {
            background-color: #2a2a2a;
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.1);
        }

        h2 {
            color: #eab308;
            border-bottom: 1px solid #444;
            padding-bottom: 5px;
        }

        ul {
            padding-left: 20px;
        }

        code {
            background: #2d2d2d;
            padding: 2px 4px;
            border-radius: 4px;
            color: #f8f8f2;
        }
    </style>
</head>

<body>

    <header>
        <h1>PHP Demonstration</h1>
        <p>Today is <strong><?php echo $currentDate; ?></strong></p>
    </header>

    <main>

        <section>
            <h2>Introduction</h2>
            <p>My name is <?php echo $fullName; ?>, but you can call me <strong><?php echo $nickname; ?></strong>.</p>
            <p><?php echo greetUser(); ?></p>
        </section>

        <section>
            <h2>Data Types</h2>
            <ul>
                <li>Integer: <?php echo $x; ?></li>
                <li>Float: <?php echo $y; ?></li>
                <li>Boolean: <?php echo $state ? "True" : "False"; ?></li>
                <li>Array Example: <?php echo implode(", ", $names); ?></li>
            </ul>
        </section>

        <section>
            <h2>Arithmetic Operators</h2>
            <ul>
                <li>Addition: <?php echo $y + $x; ?></li>
                <li>Subtraction: <?php echo $y - $x; ?></li>
                <li>Multiplication: <?php echo $y * $x; ?></li>
                <li>Division: <?php echo $y / $x; ?></li>
                <li>Modulus: <?php echo $x % $x; ?></li>
                <li>Exponentiation: <?php echo $y ** $x; ?></li>
            </ul>
        </section>

        <section>
            <h2>Comparison & Logical Operators</h2>
            <ul>
                <li><?php echo ($y == $x) ? "Equal" : "Not equal"; ?></li>
                <li><?php echo ($y != $x) ? "Not equal" : "Equal"; ?></li>
                <li>Logical AND: <?php echo (True && False) ? "True" : "False"; ?></li>
                <li>Logical OR: <?php echo (True || False) ? "True" : "False"; ?></li>
                <li>Logical NOT: <?php echo (!False) ? "True" : "False"; ?></li>
            </ul>
        </section>

        <section>
            <h2>Conditional Statements</h2>
            <?php
            $score = 85;
            if ($score >= 90) {
                echo "<p>Grade: A</p>";
            } elseif ($score >= 75) {
                echo "<p>Grade: B</p>";
            } else {
                echo "<p>Grade: C</p>";
            }
            ?>
        </section>

        <section>
            <h2>Switch Example</h2>
            <?php
            $color = "red";
            switch ($color) {
                case "red":
                    echo "<p>Stop!</p>";
                    break;
                case "yellow":
                    echo "<p>Caution!</p>";
                    break;
                case "green":
                    echo "<p>Go!</p>";
                    break;
                default:
                    echo "<p>Unknown signal</p>";
            }
            ?>
        </section>

        <section>
            <h2>Loops</h2>
            <h3>For Loop</h3>
            <ul>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <li>Iteration <?php echo $i; ?></li>
                <?php endfor; ?>
            </ul>

            <h3>Foreach Loop</h3>
            <ul>
                <?php foreach ($names as $value): ?>
                    <li><?php echo $value; ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>While Loop</h3>
            <ul>
                <?php
                $count = 1;
                while ($count <= 3):
                ?>
                    <li>While count: <?php echo $count; ?></li>
                <?php
                    $count++;
                endwhile;
                ?>
            </ul>

            <h3>Do-While Loop</h3>
            <ul>
                <?php
                $count = 1;
                do {
                    echo "<li>Do-While count: $count</li>";
                    $count++;
                } while ($count <= 3);
                ?>
            </ul>
        </section>

        <section>
            <h2>Array Examples</h2>
            <p>First fruit: <?php echo $fruits[0]; ?></p>
            <p>User email: <?php echo $user["email"]; ?></p>
            <p>Second user name: <?php echo $users[1]["name"]; ?></p>

            <h3>Sorted Numbers</h3>
            <?php
            $xs = [5, 3, 8];
            sort($xs);
            echo "<p>Ascending: " . implode(", ", $xs) . "</p>";
            rsort($xs);
            echo "<p>Descending: " . implode(", ", $xs) . "</p>";
            ?>
        </section>

        <section>
            <h2>Array Filtering (Admins)</h2>
            <ul>
                <?php
                $admins = array_filter($users, fn($u) => $u["role"] === "admin");
                foreach ($admins as $admin):
                ?>
                    <li><?php echo $admin["name"]; ?> is an admin</li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section>
            <h2>Function Returning Array</h2>
            <ul>
                <?php foreach (getProducts() as $product): ?>
                    <li><?php echo $product["name"]; ?>: $<?php echo $product["price"]; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> <?php echo $fullName; ?> - PHP Demo</p>
    </footer>

</body>

</html>