import { HTMLAttributes } from 'react';

interface ShowNameProps extends HTMLAttributes<HTMLHeadingElement> {
    name: string;
}

function ShowAuthor({ name, ...rest }: ShowNameProps) {
    return <span {...rest}>{name}</span>;
}

export default ShowAuthor;
