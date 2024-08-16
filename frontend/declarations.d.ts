type Author = {
  id: string;
  name: string;
};

type Book = {
  id: string;
  title: string;
  author: Author;
  publisher: string;
  coverUrl?: string;
  createdAt: string;
  updatedAt: string;
};
