<head>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<script>
        /* 내용적는 칸 기능 추가 */
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],
            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['clean', 'image'],    // remove formatting button
            [{ 'size': ['small', false, 'large', 'huge'] }],// custom dropdown => class로 적용되기에 다른 파일이 더 필요함. 따라서 지금은 적용 안 됨.
            [{ 'font': [] }]
        ];

        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
</script>



이건 참고용
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기10</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style10.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
</style>
</head>

<body>
    <div class="boardwrite_container shadow rounded">
        <h3>글쓰기</h3>
        <hr>
        <div class="row g-3 align-items-center margin">
            <div class="col-auto"><label style="width: 80px;" for="title">제목</label></div>
            <div class="col-auto" style="width: 85%;"> <!-- 입력 칸 너비: 컨테이너의 85% -->
                <input type="text" placeholder="제목" class="form-control" id="title" autofocus>
            </div>
        </div>

        <div class="row g-3 align-items-start margin">
            <!-- align-items-start: 내용(label) 중간 말고 위에 나타나도록 -->
            <div class="col-auto"><label style="width: 80px;" for="content">내용</label></div>
            <div class="col-auto" style="width: 85%;"><!-- <textarea rows="10" class="form-control" placeholder="내용"
                        id="content"></textarea> -->
                <div id="editor" style="height: 400px;"></div>
            </div>
        </div>
        <div class="row g-3 align-items-center margin">
            <div class="col-auto"><label style="width: 80px;" for="writer">작성자</label></div>
            <div class="col-auto" style="width: 85%;"><input type="text" placeholder="작성자" class="form-control"
                    id="writer"></div>
        </div>
        <div class="row g-3 align-items-center margin">
            <div class="col-auto"><label style="width: 80px;"></label></div>
            <div class="col-auto">
                <input type="submit" class="btn btn-secondary" value="작성" onclick="boardwriteAction()">
                <a href="board10.html" class="btn btn-primary">목록으로</a>
            </div>

        </div>
    </div>


    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> <!-- quill -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- sweetalert -->
    <script>
        /* 내용적는 칸 기능 추가 */
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],
            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['clean', 'image'],    // remove formatting button
            [{ 'size': ['small', false, 'large', 'huge'] }],// custom dropdown => class로 적용되기에 다른 파일이 더 필요함. 따라서 지금은 적용 안 됨.
            [{ 'font': [] }]
        ];

        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });




        async function boardwriteAction() {
            /* 유효성 검사 */
            if (title.value.length < 1) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "제목을 입력하시오",
                    // 커서 옮기기
                    didClose: () => {
                        title.focus();
                    }
                });
            }
            else if (quill.getText().length <= 1) { // 이미지만 넣을 때는 또 안되네...
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "내용을 입력하시오",
                    // 커서 옮기기
                    didClose: () => {
                        quill.root.focus();
                    }
                });
            }
            else if (writer.value.length < 1) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "작성자를 입력하시오",
                    // 커서 옮기기
                    didClose: () => {
                        writer.focus();
                    }
                });
            }
            else {
                /* 서버에 글쓰기 데이터 보내기 */
                const url = `http://ihongss.com:13000/api/board/insert.json`;
                const headers = { "Content-Type": "application/json" };
                const body = {
                    title: title.value,
                    content: quill.root.innerHTML, //quill.getText()를 쓰면 태그가 제거됨.
                    writer: writer.value
                }
                const { data } = await axios.post(url, body, { headers });
                console.log(data);
                if (data.status == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Your work has been saved",
                        text: "글쓰기를 성공하셨습니다.",
                        // 커서 옮기기
                        didClose: () => {
                            writer.focus();
                            window.location.href = "board10.html";
                        }
                    });
                }
            }
        }
    </script>
</body>

</html>