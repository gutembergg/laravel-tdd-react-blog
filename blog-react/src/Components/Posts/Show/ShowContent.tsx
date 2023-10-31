import { HTMLAttributes } from 'react';

interface ShowContentProps extends HTMLAttributes<HTMLHeadingElement> {
    content: string;
}

function ShowContent({ content, ...rest }: ShowContentProps) {
    return <p className={`text-center ${rest.className}`}>{content}</p>;
}

export default ShowContent;
