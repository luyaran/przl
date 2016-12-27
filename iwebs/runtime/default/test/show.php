<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>朴智妍</title>
</head>
<body>
<center>
    <table>
        <tr>
            <th>编号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>操作</th>
        </tr>
        <foreach name="arr" item="val">
        <tr>
            <td><?php echo isset($val.id)?$val.id:"";?></td>
            <td><?php echo isset($val.name)?$val.name:"";?></td>
            <td><?php echo isset($val.sex)?$val.sex:"";?></td>
            <td>
                <a href="http://www.przl.com/iwebs/index.php/test/del?id=<?php echo isset($val.id)?$val.id:"";?>">删除</a>
                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <a href="http://www.przl.com/iwebs/index.php/test/upd?id=<?php echo isset($val.id)?$val.id:"";?>">修改</a>
            </td>
        </tr>
        </foreach>
    </table>
</center>

</body>
</html>