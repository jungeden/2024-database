import { useParams } from "react-router-dom";
import { useEffect, useState } from "react";
import { getPost, IPost } from "./api/api";
import * as DOMPurify from "dompurify";

function Post() {
  const { id } = useParams();
  const [data, setData] = useState < IPost > {};

  useEffect(() => {
    getPost(id + "").then((res) => setData(res));
  }, []);

  return (
    <div>
      <PostTitle title={data?.title} />
      {data?.content && (
        <div
          style={{
            width: "60vw",
            whiteSpace: "normal",
          }}
          dangerouslySetInnerHTML={{
            __html: DOMPurify.sanitize(String(data?.content)),
          }}
        />
      )}
    </div>
  );
}

export default Post;
