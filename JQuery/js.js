function removeOdd(array) {
    var a_l = array.length;
    for (var i = 0; i < a_l; i++) {
        if (array[i] % 2 === 1) {
            array.splice(i, 1);
        }
        //偶数なら何もしない。
    }
}

function removeOdd(array) {
    array.forEach((a, b, c) => {
        while (c[b] % 2 == 1) { c.splice(b, 1) }
    });
}

/*列の長さが変わっているのに、forEachは使うべきでは無いと思います。
whileを使ってたまたま正解扱いにできただけで、普遍的な解答では無いと思います。*/

function removeOdd(array) {
    while (array.findIndex(v => v % 2 === 1) !== -1) {
        array.splice(array.findIndex(v => v % 2 === 1), 1);
    }
    return array;
}
/*findIndexは配列の中で条件を満たすインデックスを返すものなので、そのテスト処理の中で、配列の削除といった処理は行うべきではないと思います。
③spliceについて
引数が1つしかないのが良くないです。
引数が1つだけの場合は、indexの位置から末端までを取り除きます。
例えば、*/

/*ループの終了条件にarray.lengthを使っている
この問題ではarrayの長さが徐々に短くなるのでこれでは全部の要素に対してループの処理が行われるとは限りません。

この場合for文よりもwhile文を使ってfindIndexの返り値が-1でない間という条件にした方が良いと思います。
*/

///////////////

function addSumToMiddle(array) {
    let array2 = array;
    let i = 0;
    while (i + 1 < array2.length) {
        array2.splice(i + 1, 0, array2[i] + array2[i + 1]);
        i += 2;
    };
    array = array2;
    return array;
};

function addSumToMiddle(array) {
    let clone = array.slice();
    let index = 1;
    for (let i = 0; i < clone.length - 1; i++) {
        let middle = clone[i] + clone[i + 1];
        array.splice(index, 0, middle);
        index += 2;
    }
    return array;
}

function addSumToMiddle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        let plus = array[i] + array[i - 1];
        array.splice(i, 0, plus);
    }
}
/*良いと思います。
ループを後ろから回して配列の長さの変更の影響を受けないようにしている点がGoodです。*/


function makePrimeArray(n) {
    var arr = []; // return 用配列
    for (var i = 2; i < n + 1; i++) { // 引数n 分、１から順にループさせる
        var sosu = true; // [素数: true] [他: false]
        for (var j = 2; j < i + 1; j++) { // 元ループの i と同じ数になるまで、1から順にループさせる
            if (i % j === 0 && i !== j) {
                sosu = false; // 「１」か「自身」以外で割り切れる場合「素数」ではない
            }
        }
        if (sosu) arr.push(i); // 素数の場合、返却用配列に格納
    }
    return arr;
}



function makePrimeArray(n) {
    let primes = [];
    for (let i = 2; i <= n; i++) {
        //every()メソッドは、空の配列ではあらゆる条件式に対して true を返す
        let result = primes.every(p => {
            return i % p !== 0;
        });
        if (result) primes.push(i);
    }
    return primes;
}

function makePrimeArray(n) {
    let array = [];
    for (let i = 2; i <= n; i++) {
        if (isPrime(i)) {
            array.push(i);
        }
    }
    return array;
}

function isPrime(num) {
    //2 は素数なので true を返す
    if (num === 2) {
        return true;
    } else {
        for (i = 2; i < num; i++) {
            // 余りが0になれば素数ではない。したがってfalse を返す。
            if (num % i === 0) {
                return false;
            }
        }
        // 余りが1回も0にならなかったので、素数。したがってtrue を返す。
        return true;
    }
}

$("button").click(() => {
    const $result = $(".result");
    $result.html("Hello");
});

$("button").on("click", () => {
    // ここの処理は同じ
});