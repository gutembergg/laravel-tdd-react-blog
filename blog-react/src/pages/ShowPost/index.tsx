import { useParams } from 'react-router-dom';
import { Show } from '../../Components/Posts/Show';
import { useApiRequests } from '../../hooks/useApiRequest';
import DefaultLayout from '../../layouts/DefaultLayout';
import { Post } from '../../Interfaces/Post';
import { checkHasImage, formaterPost } from '../../Utils/Api/formaterPosts';

function ShowPost() {
    const { slug } = useParams();

    const { data } = useApiRequests<Post>(`http://localhost/api/posts/show/${slug}`);

    if (!data) {
        return <div>Not found</div>;
    }

    const formatedPost = formaterPost(data);

    console.log('formatedPost', formatedPost);

    return (
        <DefaultLayout>
            <Show.Root>
                <Show.Image path={checkHasImage(formatedPost).path} name={formatedPost.title} />
                <Show.Title title={formatedPost.title} />
                <Show.Content content={formatedPost.content} />
                <div>
                    <Show.Date date={formatedPost.created_at} />
                </div>
            </Show.Root>
        </DefaultLayout>
    );
}

export default ShowPost;
