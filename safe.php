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

    if(isset($_POST["submit"])){
        $validity= true;


        //Sanitze and validate  salary
        $salary = $_POST["salary"];
        $salary = filter_var($sal, FILTER_SANITIZE_NUMBER_FLOAT);

		if(!filter_var($salary, FILTER_VALIDATE_FLOAT)){
            $salary_error = "there's something wrong with your input input";
            $validity = false;
        }
        
        if(!filter_var($taxFree, FILTER_VALIDATE_FLOAT)){
            $taxFree_error = "there's something wrong with your input input";
            $validity = false;
        }

        if(isset($_POST["salaryType"])){

            // check if the user mess with the radio values
            if($_POST["salaryType"] != "yearly" || $_POST["salaryType"] != "monthly") {
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
                $totalMonthlySalary = $salary;

                //salary < 10,000$: 0% tax
                //10,000$ < salary < 25,000$: 11% Tax

              // // 25,000$ < salary < 50,000$: 30% tax
              ///  salary > 50,000$: 45% tax
                switch($salary*12){
                    case $salary<10000: $monthlyTax=0;break;
                    case ($salary>10000 && $salary<25000): $monthlyTax=$salary*12*11/100;break;
                    case ($salary>25000 && $salary<50000): $monthlyTax=$salary*12*30/100;break;
                    case ($salary>50000): $monthlyTax=$salary*12*45/100;break;
                }
                
                
                $montlySecurityFee =($salary*12>10000)? ($salary*12*4/100) :0;
                $montlySalaryAfterTax =($salary*12)-$monthlyTax-$montlySecurityFee+$taxFree*12;
            }else{

                switch($salary){
                    case $salary<10000: $yearlyTax=0;break;
                    case ($salary>10000 && $salary<25000): $yearlyTax=$salary*11/100;break;
                    case ($salary>25000 && $salary<50000): $yearlyTax=$salary*30/100;break;
                    case ($salary>50000): $yearlyTax=$salary*45/100;break;
                }
                
                
                $yearlySecurityFee =($salary>10000)? ($salary*4/100) :0;
                $montlySalaryAfterTax =($salary)-$yearlyTax-$yearlySecurityFee+$taxFree;
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
</head>
<body>
    <header>
        <h1>Income Tax Calculator :</h1>
        <h2> Hello <?php echo " ".$userName ?> </h2>
    </header>  
    <main>
        <form action="<?php $_SERVER["self"] ?>" method="post" >

            <label for="salary">Enter Your Salary</label>
            <input type="number" name="salary" id="salary" value="<?php echo $salary; ?>">

            <label for="salaryType">Your Salary is Yearly or monthly:</label>
            <input type="radio" name="salaryType" id="salaryType" value="yearly" <?php if($yearly) echo "checked"; ?> >
            <input type="radio" name="salaryType" id="salaryType" value="monthly" <?php if($monthly) echo "checked"; ?>>

            <label for="taxFree">Enter Your Salary</label>
            <input type="number" name="taxFree" id="taxFree" value="<?php echo $taxFree; ?>" >

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