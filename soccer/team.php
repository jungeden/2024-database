<?

echo(" <h1 style='text-align:center;'>k-리그 순위</h1>");
        $con = mysqli_connect("localhost", "root", "0000", "class");
        $sql = "SELECT * from team order by point desc, deuk-sil desc";
        
        $result = mysqli_query($con, $sql);
        $total = mysqli_num_rows($result);
        echo("<p style='text-align:center;'><a href=show.php >경기 기록 입력</a></p>");
        echo("<table border=1 width=700 align=center style='border-collapse:collapse'>
            <tr >
            <td align=center width=100>순위</td>
            <td align=center width=100>클럽</td>
            <td align=center width=100>경기</td>
            
            <td align=center width=100>승</td>
            <td align=center width=100>무</td>
          
            <td align=center width=100>패</td>
            <td align=center width=100>득점</td>
            <td align=center width=100>실점</td>
            <td align=center width=100>득실</td>
            <td align=center width=100>승점</td>
            </tr>");
            $ranknum=0;

            while ($_POST=mysqli_fetch_assoc($result)) {
                $ranknum = $ranknum+1;
                $oname = $_POST['name'];
                $owin = $_POST['win'];
                $otie = $_POST["tie"];
                $oloss = $_POST["loss"];
                $teamGame = $owin+$otie+$oloss;
                $odeuk = $_POST["deuk"];
                $osil = $_POST["sil"];
                $ds = $odeuk-$osil;
                $opoint = $_POST["point"];
              
                echo("<tr style='text-align:center;'><td>$ranknum</td><td>$oname</td> <td>$teamGame</td><td>$owin</td> <td>$otie</td> <td>$oloss</td> <td>$odeuk</td>  <td>$osil</td> <td>$ds</td> <td>$opoint</td> 
                 </tr>");
            }
            echo("</table>");

?>