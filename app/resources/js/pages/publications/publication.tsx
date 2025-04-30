import Layout from '@/pages/layout';
import { Publication as PublicationModel } from '@/types/models/publication';
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardImage,
  CardTitle,
} from "@/components/ui/card"
import ResponsiveGrid from "@/components/ui/responsiveGrid"

interface PublicationProps { 
  publications: PublicationModel[];
}

export default function Publication({ publications }: any) {
  console.log('Publications:', publications);
  return (
    <Layout>
      <ResponsiveGrid>
          {publications.map( (publication: PublicationModel) => (
            <Card key={publication.id}>
              <CardHeader>
                <CardImage src={publication.image_url} alt={publication.title} />
                <CardTitle>{publication.title}</CardTitle>
              </CardHeader>
              <CardContent>
                <CardDescription>{ publication.description }</CardDescription>
              </CardContent>
            </Card>
          ))}
        </ResponsiveGrid>
    </Layout>
  )
}