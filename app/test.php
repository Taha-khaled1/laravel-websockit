<?php



class Rectangle {
    protected $width;
    protected $height;

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getArea() {
        return $this->width * $this->height;
    }
}
/*
تم تعريف الكلاس Rectangle الذي يمثل مستطيل. لديه خاصيتين محمية (protected) هما $width و 
$height تمثل عرض وارتفاع المستطيل على التوالي. يحتوي الكلاس على ثلاثة أساليب (setWidth(), setHeight(), getArea())
 يتم استخدامها لتعيين العرض والارتفاع واحتساب مساحة المستطيل.
*/
class Square extends Rectangle {
    public function setWidth($width) {
        $this->width = $width;
        $this->height = $width;
    }

    public function setHeight($height) {
        $this->width = $height;
        $this->height = $height;
    }
}
/*
تم تعريف الكلاس Square الذي يمتد من الكلاس Rectangle، ويمثل مربعًا. يهمل الكلاس Square الأساليب setWidth() و 
setHeight() في Rectangle ويقوم بتعديلها لتضبيط العرض والارتفاع بنفس القيمة، وذلك لأن المربع له طول وعرض متساوي.
*/
function printArea(Rectangle $rectangle) {
    $rectangle->setWidth(4);
    $rectangle->setHeight(5);
    echo "Area: " . $rectangle->getArea() . "\n";
}
/*
تم تعريف الدالة printArea() التي تأخذ كائنًا من الكلاس Rectangle 
كمدخل. تقوم الدالة بتعيين العرض والارتفاع (بقيمة معينة في هذه الحالة) للمستطيل الذي تم تمريره
، ثم تقوم بطباعة المساحة المحسوبة بواسطة الدالة getArea().
*/



$rectangle = new Rectangle();
printArea($rectangle); // Output: Area: 20

/*
تم إنشاء كائن من الكلاس Rectangle باستخدام الكلمة المفتاحية new، ومن ثم تم استدعاء الدالة 
printArea() وتمرير الكائن Rectangle كوسيط. يتم طباعة الناتج الذي يتمثل في المساحة المحسوبة للمستطيل.
*/



$square = new Square();
printArea($square); // Output: Area: 25

/*
تم إنشاء كائن من الكلاس Square باستخدام الكلمة المفتاحية new، ومن ثم تم استدعاء الدالة 
printArea() وتمرير الكائن Square كوسيط. يتم طباعة الناتج الذي يتمثل في المساحة المحسوبة للمربع.
*/