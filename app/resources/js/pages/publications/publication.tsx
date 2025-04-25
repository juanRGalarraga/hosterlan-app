import Layout from '@/pages/layout';
import { Publication as PublicationModel } from '@/types/models/publication';
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"


interface PublicationProps { 
  publications: PublicationModel[];
}

export default function Publication({ publications }: any) {
  return (
    <Layout>
      {publications.map( (publication: PublicationModel) => (
        <Card key={publication.id}>
          <CardHeader>
            <CardTitle>{ publication.title }</CardTitle>
            <CardDescription>{ publication.description }</CardDescription>
          </CardHeader>
          <CardContent>
            <p>Card Content</p>
          </CardContent>
          <CardFooter>
            <p>{ publication.created_at }</p>
          </CardFooter>
        </Card>
      ))}
    </Layout>
  )
}