<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Помощник в счете цен</title>
</head>
<body>
    <h4>Определение количества товара и цены отгрузки</h4>

    <form method="GET" action="/">
        <div>
            <label>
                Ввведите дату
                <input type="date" name="date" value={{ $date ?? "" }}>
            </label>
            @if(isset($errors))
            <div style="color: red">
                {{ implode('. ', $errors) }}
            </div>
            @endif
        </div>
        <br/>
        <div>
            <button type="submit">Применить</button>
        </div>
    </form>
    <br/>
    @if(isset($productTotal) && isset($productToOrder) &&isset($productPrice))
        <table>
            <tr>
                <th>Количество на складе</th>
                <th>Количество в заказе</th>
                <th>Цена</th>
            </tr>
            <tr>
                <td>{{ $productTotal }}</td>
                <td>{{ $productToOrder }}</td>
                <td>{{ $productPrice }}</td>
            </tr>
        </table>
    @endif
</body>
</html>
