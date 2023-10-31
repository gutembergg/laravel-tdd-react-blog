import { HTMLAttributes } from 'react';

interface ShowTitleProps extends HTMLAttributes<HTMLHeadingElement> {
    title: string;
}

function ShowTitle({ title, ...rest }: ShowTitleProps) {
    return <h1 className={`font-semibold text-2xl ${rest.className}`}>{title}</h1>;
}

export default ShowTitle;
