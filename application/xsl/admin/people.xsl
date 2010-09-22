<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:include href="tpl.default.xsl" />

	<xsl:template name="title">
		<title>Admin - People</title>
	</xsl:template>

  <xsl:template match="/">
    <xsl:call-template name="template" />
  </xsl:template>

	<!-- List fields -->
  <xsl:template match="content[../meta/controller = 'people' and ../meta/action = 'index']">
		<h1>People</h1>

		<p><a href="people/add_person">Add person</a></p>
  </xsl:template>

	<!-- Add person -->
  <xsl:template match="content[../meta/controller = 'people' and ../meta/action = 'add_person']">
		<h1>Add person</h1>

		<form method="post" action="people/add_person">
			<table>
				<tfoot>
					<tr>
						<th colspan="2" align="right" class="tblFooters">
							<input type="submit" value="Add" />
						</th>
					</tr>
				</tfoot>
				<tbody>
					<xsl:for-each select="people/field">
						<tr>
							<td><xsl:value-of select="name" /></td>
							<td>
								<xsl:call-template name="input_field">
									<xsl:with-param name="name" select="@id" />
									<xsl:with-param name="options" select="options" />
								</xsl:call-template>
							</td>
						</tr>
					</xsl:for-each>
					<!--tr>
						<td align="center">Firstname</td>
						<td>
							<input type="text" name="firstname" value="" size="40" class="textfield" tabindex="4" id="field_2_3" />
						</td>
					</tr>
					<tr>
						<td align="center">Lastname</td>
						<td>
							<input type="text" name="lastname" value="" size="40" class="textfield" tabindex="7" id="field_3_3" />
						</td>
					</tr>
					<tr>
						<td align="center">Address</td>
						<td>
							<input type="text" name="address" value="" size="40" class="textfield" tabindex="10" id="field_4_3" />
						</td>
					</tr>
					<tr>
						<td align="center">zipcode</td>
						<td>
							<input type="text" name="zipcode" value="" size="36" class="textfield" tabindex="13" id="field_5_3" />
						</td>
					</tr>
					<tr>
						<td align="center">city</td>
						<td>
							<input type="text" name="city" value="" size="40" class="textfield" tabindex="16" id="field_6_3" />
						</td>
					</tr>
					<tr>
						<td align="center">country</td>
						<td>
							<input type="text" name="country" value="" size="11" class="textfield" tabindex="19" id="field_7_3" />
						</td>
					</tr>
					<tr>
						<td align="center">email</td>
						<td>
							<input type="text" name="email" value="" size="40" class="textfield" tabindex="22" id="field_8_3" />
						</td>
					</tr>
					<tr>
						<td align="center">homephone</td>
						<td>
							<input type="text" name="homephone" value="" size="40" class="textfield" tabindex="25" id="field_9_3" />
						</td>
					</tr>
					<tr>
						<td align="center">cellphone</td>
						<td>
							<input type="text" name="cellphone" value="" size="40" class="textfield" tabindex="28" id="field_10_3" />
						</td>
					</tr>
					<tr>
						<td align="center">workphone</td>
						<td>
							<input type="text" name="workphone" value="" size="40" class="textfield" tabindex="31" id="field_11_3" />
						</td>
					</tr>
					<tr>
						<td align="center">family_id</td>
						<td>
							<input type="text" name="family_id" value="" size="11" class="textfield" tabindex="34" id="field_12_3" />
						</td>
					</tr>
					<tr>
						<td align="center">billing_address</td>
						<td>
							<textarea name="billing_address" rows="7" cols="40" dir="ltr" id="field_13_3" tabindex="37"></textarea>
						</td>
					</tr>
					<tr>
						<td align="center">billing_comments</td>
						<td>
							<input type="text" name="billing_comments" value="" size="11" class="textfield" tabindex="40" id="field_14_3" />
						</td>
					</tr>
					<tr>
						<td align="center">password</td>
						<td>
							<input type="text" name="password" value="" size="40" class="textfield" tabindex="49" id="field_17_3" />
						</td>
					</tr-->
				</tbody>
			</table>
		</form>

  </xsl:template>

</xsl:stylesheet>
