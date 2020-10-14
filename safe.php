<?php 
$salary = "";
$taxFree = "";
$monthly= false;
$yearly= false;
$validity = false;

$totalMonthlySalary ="";
$totalYearlySalary ="";
$monthlyTax ="";
$yearlyTax ="";
$montlySecurityFee ="";
$yearlySecurityFee ="";
$montlySalaryAfterTax ="";
$yearlySalaryAfterTax ="";

$taxFree_error ="";
$salaryType_error="";
$salary_error="";


    if(isset($_POST["submit"])){
        $validity= true;

        //Sanitze and validate  salary
        $salary = $_POST["salary"];
        $taxFree = $_POST["taxFree"];
        
        $salary = filter_var($salary, FILTER_SANITIZE_NUMBER_INT);
        $taxFree = filter_var($taxFree, FILTER_SANITIZE_NUMBER_INT);
        


		if(!filter_var($salary, FILTER_VALIDATE_INT) || $salary < 0 ){
            
            $salary_error = "there's something wrong with your input input";
            $validity = false;
        }
        
        if(!filter_var($taxFree, FILTER_VALIDATE_INT) || $taxFree<-1){
     

            $taxFree_error = "there's something wrong with your input input";
            $validity = false;
        }

        if(isset($_POST["salaryType"])){

            // check if the user mess with the radio values
            if($_POST["salaryType"] !== "yearly" && $_POST["salaryType"] !== "monthly") {
                $salaryType_error = "there's something wrong with your input input";
                $validity = false;
            }else{
                if($_POST["salaryType"] == "yearly" ){
                    $yearly= true;
                }else{
                    $monthly= true;
                }
            }
        }


        if($validity){
            if($monthly){
                
                // Times 12 to convert it to yearly
                $salary*=12;
                $taxFree*=12;

                $totalMonthlySalary = $salary;
                switch($salary){
                    case $salary<10000: $monthlyTax=0;break;
                    case ($salary>10000 && $salary<25000): $monthlyTax=$salary*11/100;break;
                    case ($salary>25000 && $salary<50000): $monthlyTax=$salary*30/100;break;
                    case ($salary>50000): $monthlyTax=$salary*45/100;break;
                }
                
                $montlySecurityFee =($salary>10000)? ($salary*4/100) :0;
                $montlySalaryAfterTax =$salary-$monthlyTax-$montlySecurityFee+$taxFree;
            }else{
                $totalYearlySalary = $salary;
                switch($salary){
                    case $salary<10000: $yearlyTax=0;break;
                    case ($salary>10000 && $salary<25000): $yearlyTax=$salary*11/100;break;
                    case ($salary>25000 && $salary<50000): $yearlyTax=$salary*30/100;break;
                    case ($salary>50000): $yearlyTax=$salary*45/100;break;
                }
                
                
                $yearlySecurityFee =($salary>10000)? ($salary*4/100) :0;
                $yearlySalaryAfterTax =$salary-$yearlyTax-$yearlySecurityFee+$taxFree;
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Tax Calculator </title>
    <link rel="stylesheet" href="css/calculator.css">
</head>
<body>
    <header>
        <h1>Income Tax Calculator :</h1>
        <h2> Hello <?php echo " ".$userName ?> </h2>
    </header>  
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >

            <div>
                <label for="salary">Enter Your Salary</label>
                <input type="number" name="salary" id="salary" value="<?php echo $salary; ?>">
            </div>
            <?php if($salary_error != "") echo "<span class='error'> $salary_error  </span>" ?>

            <div>
                <label for="monthly">monthly:</label>
                <input type="radio" name="salaryType" id="monthly" value="yearly" <?php if($yearly) echo "checked"; ?> >
                <label for="yearly">monthly:</label>
                <input type="radio" name="salaryType" id="yearly" value="monthly" <?php if($monthly) echo "checked"; ?>>
            </div>
            <?php if($salaryType_error != "") echo "<span class='error'> $salaryType_error  </span>" ?>

            <div>
                <label for="taxFree">Enter Your Salary</label>
                <input type="number" name="taxFree" id="taxFree" value="<?php echo $taxFree; ?>" >
            </div>
            <?php if($taxFree_error != "") echo "<span class='error'> $taxFree_error  </span>" ?>

            <input type="submit" name="submit" value="Calculate">

        </form>
        
        <!--Result-->
        
        <?php if ($validity): ?>
            
            <table>
            <tr>
                <th></th>
                <th>Monthly</th>
                <th>Yearly</th>
            </tr>
            <tr>
                <td>Total Salary</td>
                <td> <?php echo $totalMonthlySalary; ?></td>
                <td> <?php echo $totalYearlySalary; ?></td>
            </tr>
            <tr>
                <td>Tax Ammount</td>
                <td><?php echo $monthlyTax; ?></td>
                <td><?php echo $yearlyTax; ?></td>
            </tr>

            <tr>
                <td>Social security fee</td>
                <td> <?php echo $montlySecurityFee ?> </td>
                <td> <?php echo $yearlySecurityFee ?></td>
            </tr>
            <tr>
                <td>Salary after tax</td>
                <td><?php echo $montlySalaryAfterTax ?></td>
                <td><?php echo $yearlySalaryAfterTax ?></td>
            </tr>

            </table>

        <?php endif?>
    </main>

</body>
</html>